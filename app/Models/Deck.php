<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Deck extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'visibility',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function flashcards(): BelongsToMany
    {
        return $this->belongsToMany(Flashcard::class);
    }

    public function voters(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'deck_votes')
            ->withTimestamps();
    }

    public function completedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'completed_decks')
            ->withPivot('completed_at');
    }
}