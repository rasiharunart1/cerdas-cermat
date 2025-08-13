<?php

namespace App\Livewire\Host;

use App\Models\Competition;
use Livewire\Attributes\On;
use Livewire\Component;

class ControlPanel extends Component
{
    public Competition $competition;
    public ?string $selectedQuestionId = null;
    public array $participants = [];
    public ?array $currentQuestion = null;
    public ?string $firstBuzzParticipant = null;

    public function mount(Competition $competition)
    {
        $this->competition = $competition;
        $this->loadData();
    }

    public function openQuestion()
    {
        if (!$this->selectedQuestionId) {
            return;
        }

        $response = \Illuminate\Support\Facades\Http::post(url("/competitions/{$this->competition->id}/question/open"), [
            'question_id' => $this->selectedQuestionId
        ]);

        if ($response->successful()) {
            $this->loadData();
        }
    }

    public function markCorrect()
    {
        if (!$this->competition->first_buzz_participant_id) {
            return;
        }

        $response = \Illuminate\Support\Facades\Http::post(url("/competitions/{$this->competition->id}/answer/correct"), [
            'participant_id' => $this->competition->first_buzz_participant_id
        ]);

        if ($response->successful()) {
            $this->loadData();
        }
    }

    public function markWrong()
    {
        if (!$this->competition->first_buzz_participant_id) {
            return;
        }

        $response = \Illuminate\Support\Facades\Http::post(url("/competitions/{$this->competition->id}/answer/wrong"), [
            'participant_id' => $this->competition->first_buzz_participant_id
        ]);

        if ($response->successful()) {
            $this->loadData();
        }
    }

    public function nextQuestion()
    {
        $response = \Illuminate\Support\Facades\Http::post(url("/competitions/{$this->competition->id}/question/next"));

        if ($response->successful()) {
            $this->loadData();
            $data = $response->json();
            
            if (isset($data['finished']) && $data['finished']) {
                session()->flash('message', 'Kompetisi telah selesai!');
            }
        }
    }

    public function updateStatus(string $status)
    {
        $this->competition->update(['status' => $status]);
        $this->loadData();
    }

    #[On('echo-private:competition.{competition.id},first-buzzed')]
    public function firstBuzzed($event)
    {
        $this->loadData();
    }

    #[On('echo-private:competition.{competition.id},score-updated')]
    public function scoreUpdated()
    {
        $this->loadData();
    }

    private function loadData()
    {
        $this->competition->refresh();
        
        // Load participants with scores
        $this->participants = $this->competition->participants()
            ->orderBy('score', 'desc')
            ->get()
            ->toArray();

        // Load current question
        if ($this->competition->current_question_id) {
            $this->currentQuestion = $this->competition->currentQuestion->toArray();
        } else {
            $this->currentQuestion = null;
        }

        // Load first buzz participant
        if ($this->competition->first_buzz_participant_id) {
            $this->firstBuzzParticipant = $this->competition->firstBuzzParticipant->display_name;
        } else {
            $this->firstBuzzParticipant = null;
        }
    }

    public function render()
    {
        $questions = $this->competition->questions;
        
        return view('livewire.host.control-panel', [
            'questions' => $questions
        ])->layout('layouts.app');
    }
}
