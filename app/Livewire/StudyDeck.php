<?php

namespace App\Livewire;

use App\Models\Deck;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Study Deck')]
class StudyDeck extends Component
{
    public Deck $deck;

    public int $currentIndex = 0;
    public bool $isFlipped = false;
    public bool $isCompleted = false;

    public function mount(Deck $deck): void
    {
        $this->deck = $deck;

        if (Auth::check()) {
            $this->isCompleted = $deck->completedBy()
                ->where('user_id', Auth::id())
                ->exists();
        }
    }

    public function flipCard(): void
    {
        $this->isFlipped = ! $this->isFlipped;
    }

    public function nextCard(): void
    {
        $total = $this->deck->flashcards()->count();

        if ($this->currentIndex < $total - 1) {
            $this->currentIndex++;
            $this->isFlipped = false;
        }
    }

    public function previousCard(): void
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
            $this->isFlipped = false;
        }
    }

    public function goToCard(int $index): void
    {
        $total = $this->deck->flashcards()->count();

        if ($index >= 0 && $index < $total) {
            $this->currentIndex = $index;
            $this->isFlipped    = false;
        }
    }

    public function restartDeck(): void
    {
        $this->currentIndex = 0;
        $this->isFlipped    = false;
    }

    public function toggleCompleted(): void
    {
        abort_unless(Auth::check(), 403);

        $user = Auth::user();

        if ($this->isCompleted) {
            $this->deck->completedBy()->detach($user->id);
            $this->isCompleted = false;
        } else {
            $this->deck->completedBy()->attach($user->id, [
                'completed_at' => now(),
            ]);
            $this->isCompleted = true;
        }
    }

   public function render()
{
    $flashcards  = $this->deck->flashcards()->get();
    $currentCard = $flashcards->get($this->currentIndex);

    return view('livewire.pages.study-deck', [
        'flashcards'  => $flashcards,
        'currentCard' => $currentCard,
        'total'       => $flashcards->count(),
    ]);
}
    }
