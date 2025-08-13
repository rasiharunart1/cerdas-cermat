<?php

namespace App\Livewire\Participant;

use App\Models\Competition;
use App\Models\Participant;
use Livewire\Attributes\On;
use Livewire\Component;

class BuzzerButton extends Component
{
    public Competition $competition;
    public ?Participant $participant;
    public string $status = 'waiting'; // waiting, ready, buzzed, first
    public ?string $currentQuestion = null;
    public bool $canBuzz = false;
    public string $firstBuzzParticipant = '';

    public function mount(Competition $competition)
    {
        $this->competition = $competition;
        
        // Get participant from session
        $participantId = session('participant_id');
        $this->participant = $participantId ? Participant::find($participantId) : null;
        
        if (!$this->participant || $this->participant->competition_id !== $competition->id) {
            return redirect()->route('participant.join');
        }

        $this->updateStatus();
    }

    public function buzz()
    {
        if (!$this->canBuzz || !$this->participant) {
            return;
        }

        // Disable further buzzing
        $this->canBuzz = false;
        $this->status = 'buzzed';

        // Send buzz request
        $response = \Illuminate\Support\Facades\Http::post(url("/competitions/{$this->competition->id}/buzz"), [
            'participant_id' => $this->participant->id
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['first']) {
                $this->status = 'first';
            }
        }
    }

    #[On('echo-private:competition.{competition.id},question-opened')]
    public function questionOpened($event)
    {
        $this->currentQuestion = $event['question_text'];
        $this->canBuzz = true;
        $this->status = 'ready';
        $this->firstBuzzParticipant = '';
    }

    #[On('echo-private:competition.{competition.id},first-buzzed')]
    public function firstBuzzed($event)
    {
        $this->firstBuzzParticipant = $event['participant_name'];
        
        if ($event['participant_id'] != $this->participant?->id) {
            $this->canBuzz = false;
            $this->status = 'buzzed';
        }
    }

    #[On('echo-private:competition.{competition.id},score-updated')]
    public function scoreUpdated()
    {
        // Refresh participant score
        $this->participant->refresh();
    }

    private function updateStatus()
    {
        if ($this->competition->isQuestionOpen()) {
            $this->currentQuestion = $this->competition->currentQuestion->text;
            $this->canBuzz = true;
            $this->status = 'ready';
            
            if ($this->competition->first_buzz_participant_id) {
                $this->firstBuzzParticipant = $this->competition->firstBuzzParticipant->display_name;
                if ($this->competition->first_buzz_participant_id !== $this->participant?->id) {
                    $this->canBuzz = false;
                    $this->status = 'buzzed';
                }
            }
        } else {
            $this->status = 'waiting';
            $this->canBuzz = false;
            $this->currentQuestion = null;
        }
    }

    public function render()
    {
        return view('livewire.participant.buzzer-button')
            ->layout('layouts.guest');
    }
}
