<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateDeck extends Component
{
    public string $title = '';

    public string $description = '';

    public string $visibility = 'private';

    public function save(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'visibility' => ['required', 'in:public,private'],
        ]);

        $deck = auth()->user()->decks()->create($validated);

        session()->flash('success', 'Deck created successfully. Add your first flashcard below.');

        $this->redirectRoute('decks.flashcards', $deck, navigate: true);
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.create-deck');
    }
}
