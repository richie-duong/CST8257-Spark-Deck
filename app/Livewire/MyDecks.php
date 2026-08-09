<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MyDecks extends Component
{
    public function delete(int $deckId): void
    {
        $deck = auth()->user()->decks()->findOrFail($deckId);

        $deck->delete();

        session()->flash('status', 'Deck deleted successfully.');

        $this->redirectRoute('decks.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.my-decks', [
            'decks' => auth()->user()->decks()
                ->withExists([
                    'completedBy as is_completed' => function ($query) {
                        $query->where('users.id', auth()->id());
                    },
                ])
                ->latest()
                ->get(),
        ]);
    }
}
