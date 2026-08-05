<?php

namespace Tests\Feature;

use App\Livewire\CreateDeck;
use App\Livewire\EditDeck;
use App\Livewire\MyDecks;
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

        Livewire::test(CreateDeck::class)
            ->set('title', 'PHP Basics')
            ->set('description', 'Important PHP concepts.')
            ->set('visibility', 'private')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSessionHas('status', 'Deck created successfully.')
            ->assertRedirect(route('decks.index'));

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
}
