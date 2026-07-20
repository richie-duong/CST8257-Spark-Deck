<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    protected $fillable = [
        'user_id',
        'question',
        'answer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function decks()
    {
        return $this->belongsToMany(Deck::class);
    }
}