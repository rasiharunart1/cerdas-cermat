<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionOpened implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $competitionId,
        public int $questionId,
        public string $questionText
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("competition.{$this->competitionId}"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'question-opened';
    }

    public function broadcastWith(): array
    {
        return [
            'question_id' => $this->questionId,
            'question_text' => $this->questionText,
        ];
    }
}
