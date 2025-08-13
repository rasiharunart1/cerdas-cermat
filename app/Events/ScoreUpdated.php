<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScoreUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $competitionId
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("competition.{$this->competitionId}"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'score-updated';
    }
}
