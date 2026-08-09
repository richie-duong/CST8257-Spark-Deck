<?php

namespace App\Livewire;

use App\Models\Deck;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditDeck extends Component
{
    public Deck $deck;

    public string $title = '';

    public string $description = '';

    public string $visibility = 'private';

    public function mount(Deck $deck): void
    {
        abort_unless($deck->user_id === auth()->id(), 403);

        $this->deck = $deck;
        $this->title = $deck->title;
        $this->description = $deck->description ?? '';
        $this->visibility = $deck->visibility;
    }

    public function update(): void
    {
        abort_unless($this->deck->user_id === auth()->id(), 403);

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'visibility' => ['required', 'in:public,private'],
        ]);

        $this->deck->update($validated);

        session()->flash('status', 'Deck updated successfully.');

        $this->redirectRoute('decks.index', navigate: true);
    }

    public function delete(): void
    {
        abort_unless($this->deck->user_id === auth()->id(), 403);

        $this->deck->delete();

        session()->flash('status', 'Deck deleted successfully.');

        $this->redirectRoute('decks.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.edit-deck');
    }
}
