<?php

namespace App\Livewire\Participant;

use App\Models\Competition;
use App\Models\Participant;
use Livewire\Component;

class JoinCompetition extends Component
{
    public string $code = '';
    public string $displayName = '';
    public string $error = '';

    public function joinCompetition()
    {
        $this->validate([
            'code' => 'required|string|max:255',
            'displayName' => 'required|string|max:255'
        ]);

        // Find competition by code
        $competition = Competition::where('code', $this->code)->first();
        
        if (!$competition) {
            $this->error = 'Kode kompetisi tidak ditemukan.';
            return;
        }

        if ($competition->status === 'finished') {
            $this->error = 'Kompetisi sudah selesai.';
            return;
        }

        // Check if display name already exists in this competition
        $existingParticipant = Participant::where('competition_id', $competition->id)
            ->where('display_name', $this->displayName)
            ->first();

        if ($existingParticipant) {
            $this->error = 'Nama peserta sudah digunakan dalam kompetisi ini.';
            return;
        }

        // Create participant
        $participant = Participant::create([
            'competition_id' => $competition->id,
            'display_name' => $this->displayName,
            'score' => 0
        ]);

        // Store participant ID in session
        session(['participant_id' => $participant->id]);

        // Redirect to buzzer page
        return $this->redirect(route('participant.buzzer', ['competition' => $competition->code]));
    }

    public function render()
    {
        return view('livewire.participant.join-competition')
            ->layout('layouts.guest');
    }
}
