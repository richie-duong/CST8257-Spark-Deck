<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Flashcard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question',
        'answer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function decks(): BelongsToMany
    {
        return $this->belongsToMany(Deck::class);
    }
}