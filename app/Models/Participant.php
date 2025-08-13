<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    protected $fillable = [
        'competition_id',
        'user_id',
        'display_name',
        'seat_no',
        'score'
    ];

    protected $casts = [
        'score' => 'integer',
        'seat_no' => 'integer'
    ];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
    public function incrementScore(int $points): void
    {
        $this->increment('score', $points);
    }
}
