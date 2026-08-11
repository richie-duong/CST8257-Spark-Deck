<?php

namespace Tests\Feature;

use App\Livewire\ManageFlashcards;
use App\Models\Deck;
use App\Models\Flashcard;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ManageFlashcardsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_start_editing_a_flashcard_from_another_deck(): void
    {
        [$user, $managedDeck, $otherFlashcard] = $this->createDecksWithFlashcard();

        $this->actingAs($user);
        $this->expectException(ModelNotFoundException::class);

        Livewire::test(ManageFlashcards::class, ['deck' => $managedDeck])
            ->call('startEditing', $otherFlashcard->id);
    }

    public function test_user_cannot_update_a_flashcard_from_another_deck(): void
    {
        [$user, $managedDeck, $otherFlashcard] = $this->createDecksWithFlashcard();

        $this->actingAs($user);
        $this->expectException(ModelNotFoundException::class);

        Livewire::test(ManageFlashcards::class, ['deck' => $managedDeck])
            ->set('editingFlashcardId', $otherFlashcard->id)
            ->set('question', 'Changed question')
            ->set('answer', 'Changed answer')
            ->call('updateFlashcard');
    }

    public function test_user_cannot_delete_a_flashcard_from_another_deck(): void
    {
        [$user, $managedDeck, $otherFlashcard] = $this->createDecksWithFlashcard();

        $this->actingAs($user);
        $this->expectException(ModelNotFoundException::class);

        Livewire::test(ManageFlashcards::class, ['deck' => $managedDeck])
            ->call('deleteFlashcard', $otherFlashcard->id);
    }

    public function test_user_cannot_remove_a_flashcard_from_another_deck(): void
    {
        [$user, $managedDeck, $otherFlashcard] = $this->createDecksWithFlashcard();

        $this->actingAs($user);
        $this->expectException(ModelNotFoundException::class);

        Livewire::test(ManageFlashcards::class, ['deck' => $managedDeck])
            ->call('removeFromDeck', $otherFlashcard->id);
    }

    /**
     * @return array{User, Deck, Flashcard}
     */
    private function createDecksWithFlashcard(): array
    {
        $user = User::factory()->create();
        $managedDeck = Deck::factory()->for($user)->create();
        $otherDeck = Deck::factory()->for($user)->create();
        $otherFlashcard = Flashcard::factory()->for($user)->create();

        $otherDeck->flashcards()->attach($otherFlashcard);

        return [$user, $managedDeck, $otherFlashcard];
    }
}
