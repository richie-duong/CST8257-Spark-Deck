<?php

use App\Livewire\CreateDeck;
use App\Livewire\EditDeck;
use App\Livewire\ManageFlashcards;
use App\Livewire\MyDecks;
use App\Livewire\StudyDeck;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('decks', MyDecks::class)->name('decks.index');
    Route::get('decks/create', CreateDeck::class)->name('decks.create');
    Route::get('decks/{deck}/edit', EditDeck::class)->name('decks.edit');
});

// Ralph — Flashcards & Study
Route::get('decks/{deck}/flashcards', ManageFlashcards::class)
    ->middleware(['auth', 'verified'])
    ->name('decks.flashcards');

Route::get('decks/{deck}/study', StudyDeck::class)
    ->name('decks.study');

Route::view('browse-decks', 'browse-decks')
    ->middleware(['auth', 'verified'])
    ->name('decks.browse');

require __DIR__.'/auth.php';