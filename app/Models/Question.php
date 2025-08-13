<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'category',
        'text',
        'type',
        'points',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
        'points' => 'integer'
    ];

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function competitions(): BelongsToMany
    {
        return $this->belongsToMany(Competition::class, 'competition_question')
                    ->withPivot('order')
                    ->orderBy('competition_question.order');
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
    public function isMcq(): bool
    {
        return $this->type === 'mcq';
    }

    public function isShort(): bool
    {
        return $this->type === 'short';
    }

    public function getCorrectOptions()
    {
        return $this->options()->where('is_correct', true)->get();
    }
}
