<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buzz extends Model
{
    protected $fillable = [
        'competition_id',
        'question_id',
        'participant_id',
        'buzzed_at',
        'latency_ms',
        'accepted'
    ];

    protected $casts = [
        'buzzed_at' => 'datetime',
        'latency_ms' => 'integer',
        'accepted' => 'boolean'
    ];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }
}
