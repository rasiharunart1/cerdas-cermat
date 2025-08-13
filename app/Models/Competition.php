<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competition extends Model
{
    protected $fillable = [
        'name',
        'code',
        'status',
        'current_question_id',
        'question_opened_at',
        'first_buzz_participant_id'
    ];

    protected $casts = [
        'question_opened_at' => 'datetime',
        'status' => 'string'
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'competition_question')
                    ->withPivot('order')
                    ->orderBy('competition_question.order');
    }

    public function currentQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'current_question_id');
    }

    public function firstBuzzParticipant(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'first_buzz_participant_id');
    }

    public function buzzes(): HasMany
    {
        return $this->hasMany(Buzz::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    // Helper methods
    public function getRouteKeyName(): string
    {
        return 'code';
    }

    public function isRunning(): bool
    {
        return $this->status === 'running';
    }

    public function isQuestionOpen(): bool
    {
        return $this->isRunning() && 
               $this->current_question_id !== null && 
               $this->question_opened_at !== null;
    }
}
