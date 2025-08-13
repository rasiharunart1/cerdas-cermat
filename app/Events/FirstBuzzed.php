<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FirstBuzzed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $competitionId,
        public int $questionId,
        public int $participantId,
        public string $participantName
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("competition.{$this->competitionId}"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'first-buzzed';
    }

    public function broadcastWith(): array
    {
        return [
            'question_id' => $this->questionId,
            'participant_id' => $this->participantId,
            'participant_name' => $this->participantName,
        ];
    }
}
