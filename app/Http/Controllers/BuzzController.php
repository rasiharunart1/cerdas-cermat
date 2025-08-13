<?php

namespace App\Http\Controllers;

use App\Events\FirstBuzzed;
use App\Events\QuestionOpened;
use App\Events\ScoreUpdated;
use App\Models\Answer;
use App\Models\Buzz;
use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuzzController extends Controller
{
    public function openQuestion(Competition $competition, Request $request): JsonResponse
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id'
        ]);

        // Check if user can control this competition (admin/host)
        // TODO: Add authorization check

        $question = $competition->questions()->find($request->question_id);
        
        if (!$question) {
            return response()->json(['error' => 'Question not found in competition'], 404);
        }

        DB::transaction(function () use ($competition, $question) {
            // Update competition state
            $competition->update([
                'current_question_id' => $question->id,
                'question_opened_at' => now(),
                'first_buzz_participant_id' => null
            ]);

            // Clear existing buzzes for this question
            $competition->buzzes()
                ->where('question_id', $question->id)
                ->delete();
        });

        // Broadcast to all participants
        QuestionOpened::dispatch(
            $competition->id,
            $question->id,
            $question->text
        );

        return response()->json([
            'success' => true,
            'question' => [
                'id' => $question->id,
                'text' => $question->text,
                'type' => $question->type,
                'points' => $question->points
            ]
        ]);
    }

    public function buzz(Competition $competition, Request $request): JsonResponse
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id'
        ]);

        // Check if competition is running and question is open
        if (!$competition->isQuestionOpen()) {
            return response()->json(['error' => 'No question is currently open'], 400);
        }

        $participant = Participant::find($request->participant_id);
        
        if ($participant->competition_id !== $competition->id) {
            return response()->json(['error' => 'Participant not in this competition'], 403);
        }

        $isFirst = false;
        $buzzedAt = now();
        $latencyMs = $competition->question_opened_at 
            ? $buzzedAt->diffInMilliseconds($competition->question_opened_at)
            : null;

        DB::transaction(function () use ($competition, $participant, $buzzedAt, $latencyMs, &$isFirst) {
            // Create or find buzz record
            $buzz = Buzz::firstOrCreate([
                'competition_id' => $competition->id,
                'question_id' => $competition->current_question_id,
                'participant_id' => $participant->id,
            ], [
                'buzzed_at' => $buzzedAt,
                'latency_ms' => $latencyMs,
                'accepted' => false
            ]);

            // Atomically set first buzz if not already set
            $updated = DB::table('competitions')
                ->where('id', $competition->id)
                ->whereNull('first_buzz_participant_id')
                ->update(['first_buzz_participant_id' => $participant->id]);

            $isFirst = $updated > 0;
        });

        if ($isFirst) {
            // Broadcast first buzz event
            FirstBuzzed::dispatch(
                $competition->id,
                $competition->current_question_id,
                $participant->id,
                $participant->display_name
            );
        }

        return response()->json([
            'first' => $isFirst,
            'latency_ms' => $latencyMs
        ]);
    }

    public function markCorrect(Competition $competition, Request $request): JsonResponse
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id'
        ]);

        // TODO: Add authorization check

        $participant = Participant::find($request->participant_id);
        
        if ($participant->competition_id !== $competition->id) {
            return response()->json(['error' => 'Participant not in this competition'], 403);
        }

        if (!$competition->current_question_id) {
            return response()->json(['error' => 'No current question'], 400);
        }

        $question = $competition->currentQuestion;

        DB::transaction(function () use ($competition, $participant, $question) {
            // Award points to participant
            $participant->incrementScore($question->points);

            // Record the answer
            Answer::create([
                'competition_id' => $competition->id,
                'question_id' => $question->id,
                'participant_id' => $participant->id,
                'is_correct' => true,
                'points_awarded' => $question->points
            ]);
        });

        // Broadcast score update
        ScoreUpdated::dispatch($competition->id);

        return response()->json(['success' => true]);
    }

    public function markWrong(Competition $competition, Request $request): JsonResponse
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id'
        ]);

        // TODO: Add authorization check

        $participant = Participant::find($request->participant_id);
        
        if ($participant->competition_id !== $competition->id) {
            return response()->json(['error' => 'Participant not in this competition'], 403);
        }

        if (!$competition->current_question_id) {
            return response()->json(['error' => 'No current question'], 400);
        }

        // Record the wrong answer
        Answer::create([
            'competition_id' => $competition->id,
            'question_id' => $competition->current_question_id,
            'participant_id' => $participant->id,
            'is_correct' => false,
            'points_awarded' => 0
        ]);

        // Broadcast score update (even for wrong answers to update UI)
        ScoreUpdated::dispatch($competition->id);

        return response()->json(['success' => true]);
    }

    public function nextQuestion(Competition $competition): JsonResponse
    {
        // TODO: Add authorization check

        if (!$competition->current_question_id) {
            return response()->json(['error' => 'No current question'], 400);
        }

        // Find current question order
        $currentOrder = $competition->questions()
            ->where('questions.id', $competition->current_question_id)
            ->first()
            ->pivot
            ->order;

        // Find next question
        $nextQuestion = $competition->questions()
            ->where('competition_question.order', '>', $currentOrder)
            ->orderBy('competition_question.order')
            ->first();

        if ($nextQuestion) {
            $competition->update([
                'current_question_id' => $nextQuestion->id,
                'question_opened_at' => null,
                'first_buzz_participant_id' => null
            ]);

            return response()->json([
                'success' => true,
                'next_question' => [
                    'id' => $nextQuestion->id,
                    'text' => $nextQuestion->text
                ]
            ]);
        } else {
            // No more questions, finish competition
            $competition->update([
                'status' => 'finished',
                'current_question_id' => null,
                'question_opened_at' => null,
                'first_buzz_participant_id' => null
            ]);

            return response()->json([
                'success' => true,
                'finished' => true
            ]);
        }
    }
}
