<?php

namespace Tests\Feature;

use App\Livewire\CreateDeck;
use App\Livewire\EditDeck;
use App\Livewire\MyDecks;
use App\Livewire\StudyDeck;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeckManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_deck(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $component = Livewire::test(CreateDeck::class)
            ->set('title', 'PHP Basics')
            ->set('description', 'Important PHP concepts.')
            ->set('visibility', 'private')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSessionHas('success', 'Deck created successfully. Add your first flashcard below.');

        $deck = Deck::where('user_id', $user->id)
            ->where('title', 'PHP Basics')
            ->firstOrFail();

        $component->assertRedirect(route('decks.flashcards', $deck));

        $this->assertDatabaseHas('decks', [
            'user_id' => $user->id,
            'title' => 'PHP Basics',
            'description' => 'Important PHP concepts.',
            'visibility' => 'private',
        ]);
    }

    public function test_deck_form_validates_user_input(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(CreateDeck::class)
            ->set('title', '')
            ->set('visibility', 'invalid')
            ->call('save')
            ->assertHasErrors([
                'title' => 'required',
                'visibility' => 'in',
            ]);

        $this->assertDatabaseCount('decks', 0);
    }

    public function test_my_decks_only_displays_the_authenticated_users_decks(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Deck::factory()->for($user)->create(['title' => 'My Deck']);
        Deck::factory()->for($otherUser)->create(['title' => 'Another User Deck']);

        $this->actingAs($user);

        Livewire::test(MyDecks::class)
            ->assertSee('My Deck')
            ->assertDontSee('Another User Deck');
    }

    public function test_my_decks_displays_each_decks_completion_status(): void
    {
        $user = User::factory()->create();
        $completedDeck = Deck::factory()->for($user)->create([
            'title' => 'Completed Deck',
        ]);
        Deck::factory()->for($user)->create([
            'title' => 'Incomplete Deck',
        ]);

        $completedDeck->completedBy()->attach($user->id, [
            'completed_at' => now(),
        ]);

        $this->actingAs($user);

        Livewire::test(MyDecks::class)
            ->assertSee('Completed Deck')
            ->assertSee('✓ Completed')
            ->assertSee('Incomplete Deck')
            ->assertSee('Not Completed');
    }

    public function test_user_can_edit_their_deck(): void
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->for($user)->create([
            'title' => 'Old Title',
            'visibility' => 'private',
        ]);

        $this->actingAs($user);

        Livewire::test(EditDeck::class, ['deck' => $deck])
            ->assertSet('title', 'Old Title')
            ->set('title', 'Updated Title')
            ->set('description', 'Updated description.')
            ->set('visibility', 'public')
            ->call('update')
            ->assertHasNoErrors()
            ->assertSessionHas('status', 'Deck updated successfully.')
            ->assertRedirect(route('decks.index'));

        $this->assertDatabaseHas('decks', [
            'id' => $deck->id,
            'user_id' => $user->id,
            'title' => 'Updated Title',
            'description' => 'Updated description.',
            'visibility' => 'public',
        ]);
    }

    public function test_user_cannot_edit_another_users_deck(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $deck = Deck::factory()->for($otherUser)->create();

        $this->actingAs($user)
            ->get(route('decks.edit', $deck))
            ->assertForbidden();
    }

    public function test_user_can_delete_their_deck(): void
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->for($user)->create();

        $this->actingAs($user);

        Livewire::test(MyDecks::class)
            ->call('delete', $deck->id)
            ->assertSessionHas('status', 'Deck deleted successfully.')
            ->assertRedirect(route('decks.index'));

        $this->assertDatabaseMissing('decks', [
            'id' => $deck->id,
        ]);
    }

    public function test_user_can_delete_their_deck_from_the_edit_page(): void
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->for($user)->create();

        $this->actingAs($user);

        Livewire::test(EditDeck::class, ['deck' => $deck])
            ->assertSee('Delete Deck')
            ->assertDontSee('Danger Zone')
            ->call('delete')
            ->assertSessionHas('status', 'Deck deleted successfully.')
            ->assertRedirect(route('decks.index'));

        $this->assertDatabaseMissing('decks', [
            'id' => $deck->id,
        ]);
    }

    public function test_user_can_open_flashcard_management_from_their_deck_pages(): void
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->for($user)->create();
        $flashcardUrl = route('decks.flashcards', $deck);

        $this->actingAs($user);

        Livewire::test(MyDecks::class)
            ->assertSee('Study Deck')
            ->assertSee('Edit Deck')
            ->assertSee('Manage Cards')
            ->assertSee('Delete')
            ->assertSeeHtml('href="'.$flashcardUrl.'"')
            ->assertSeeHtml('href="'.route('decks.study', $deck).'"');

        Livewire::test(EditDeck::class, ['deck' => $deck])
            ->assertDontSee('Manage Flashcards')
            ->assertDontSeeHtml('href="'.$flashcardUrl.'"');
    }

    public function test_empty_deck_study_page_directs_the_owner_to_manage_cards(): void
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->for($user)->create();

        $this->actingAs($user);

        Livewire::test(StudyDeck::class, ['deck' => $deck])
            ->assertSee('No flashcards yet')
            ->assertSee('There are no cards in this deck available to study.')
            ->assertSee('Manage Flashcards')
            ->assertSeeHtml('href="'.route('decks.flashcards', $deck).'"')
            ->assertDontSee('Mark as Complete');
    }
}
