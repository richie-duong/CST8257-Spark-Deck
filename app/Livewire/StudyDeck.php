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

    public bool $isUpvoted = false;

    public int $resetCount = 0;


    public function mount(Deck $deck): void
    {
        /*
         * Only allow the deck to be viewed if the current
         * user has permission to view it.
         */
        abort_unless($deck->canBeViewedBy(Auth::user()), 404);

        $this->deck = $deck;


        /*
         * Check authenticated-user-specific state.
         */
        if (Auth::check()) {

            $userId = Auth::id();


            $this->isCompleted = $deck
                ->completedBy()
                ->where('user_id', $userId)
                ->exists();


            $this->isUpvoted = $deck
                ->voters()
                ->where('user_id', $userId)
                ->exists();
        }
    }


    /*
     * Flip the current flashcard.
     */
    public function flipCard(): void
    {
        $this->isFlipped = ! $this->isFlipped;
    }


    /*
     * Move to the next flashcard.
     */
    public function nextCard(): void
    {
        $total = $this->deck->flashcards()->count();

        if ($this->currentIndex < $total - 1) {

            $this->currentIndex++;

            $this->isFlipped = false;

            $this->resetCount++;
        }
    }


    /*
     * Move to the previous flashcard.
     */
    public function previousCard(): void
    {
        if ($this->currentIndex > 0) {

            $this->currentIndex--;

            $this->isFlipped = false;

            $this->resetCount++;
        }
    }


    /*
     * Jump directly to a flashcard.
     */
    public function goToCard(int $index): void
    {
        $total = $this->deck->flashcards()->count();

        if ($index >= 0 && $index < $total) {

            $this->currentIndex = $index;

            $this->isFlipped = false;

            $this->resetCount++;
        }
    }


    /*
     * Restart the deck.
     */
    public function restartDeck(): void
    {
        $this->currentIndex = 0;

        $this->isFlipped = false;

        $this->resetCount++;
    }


    /*
     * Toggle whether the authenticated user has
     * completed this deck.
     */
    public function toggleCompleted(): void
    {
        abort_unless(Auth::check(), 403);

        $user = Auth::user();


        if ($this->isCompleted) {

            $this->deck
                ->completedBy()
                ->detach($user->id);

            $this->isCompleted = false;

        } else {

            $this->deck
                ->completedBy()
                ->attach($user->id, [
                    'completed_at' => now(),
                ]);

            $this->isCompleted = true;
        }
    }


    /*
     * Toggle the authenticated user's upvote.
     *
     * Users are allowed to upvote their own decks as well
     * as decks created by other users.
     */
    public function toggleUpvote(): void
    {
        abort_unless(Auth::check(), 403);

        $userId = Auth::id();


        if ($this->isUpvoted) {

            $this->deck
                ->voters()
                ->detach($userId);

            $this->isUpvoted = false;

        } else {

            $this->deck
                ->voters()
                ->attach($userId);

            $this->isUpvoted = true;
        }
    }


    public function render()
    {
        $flashcards = $this->deck
            ->flashcards()
            ->get();

        $currentCard = $flashcards->get($this->currentIndex);


        /*
         * Refresh the voter relationship so the
         * upvote count is always current.
         */
        $this->deck->load('voters');


        return view('livewire.pages.study-deck', [
            'flashcards' => $flashcards,
            'currentCard' => $currentCard,
            'total' => $flashcards->count(),
            'upvoteCount' => $this->deck->voters->count(),
        ]);
    }
}