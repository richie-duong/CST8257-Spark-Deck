<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flashcards()
    {
        return $this->belongsToMany(Flashcard::class);
    }

    public function voters()
    {
        return $this->belongsToMany(User::class, 'deck_votes');
    }

    public function completedBy()
    {
        return $this->belongsToMany(User::class, 'completed_decks');
    }
}