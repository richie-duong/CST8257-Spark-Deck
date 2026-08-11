<?php

namespace Tests\Feature;

use App\Models\Deck;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeckVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_and_study_a_public_deck(): void
    {
        $owner = User::factory()->create();
        $deck = Deck::factory()->for($owner)->create(['visibility' => 'public']);

        $this->get(route('view-deck', $deck))->assertOk();
        $this->get(route('decks.study', $deck))->assertOk();
    }

    public function test_owner_can_view_and_study_their_private_deck(): void
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->for($user)->create(['visibility' => 'private']);

        $this->actingAs($user);

        $this->get(route('view-deck', $deck))->assertOk();
        $this->get(route('decks.study', $deck))->assertOk();
    }

    public function test_guest_cannot_view_or_study_a_private_deck(): void
    {
        $owner = User::factory()->create();
        $deck = Deck::factory()->for($owner)->create(['visibility' => 'private']);

        $this->get(route('view-deck', $deck))->assertNotFound();
        $this->get(route('decks.study', $deck))->assertNotFound();
    }

    public function test_another_user_cannot_view_or_study_a_private_deck(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $deck = Deck::factory()->for($owner)->create(['visibility' => 'private']);

        $this->actingAs($otherUser);

        $this->get(route('view-deck', $deck))->assertNotFound();
        $this->get(route('decks.study', $deck))->assertNotFound();
    }
}
