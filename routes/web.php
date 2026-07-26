<?php

use App\Livewire\CreateDeck;
use App\Livewire\EditDeck;
use App\Livewire\MyDecks;
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

require __DIR__.'/auth.php';
