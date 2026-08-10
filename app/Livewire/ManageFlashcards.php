<?php

namespace App\Livewire;

use App\Models\Deck;
use App\Models\Flashcard;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ManageFlashcards extends Component
{
    public Deck $deck;

    public string $question = '';
    public string $answer = '';

    public ?int $editingFlashcardId = null;
    public bool $showCreateForm = false;

    protected function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:1000'],
            'answer'   => ['required', 'string', 'max:1000'],
        ];
    }

    protected function messages(): array
    {
        return [
            'question.required' => 'The question field is required.',
            'question.max'      => 'The question may not exceed 1000 characters.',
            'answer.required'   => 'The answer field is required.',
            'answer.max'        => 'The answer may not exceed 1000 characters.',
        ];
    }

    public function mount(Deck $deck): void
    {
        abort_if($deck->user_id !== Auth::id(), 403);
        $this->deck = $deck;
    }

    public function toggleCreateForm(): void
    {
        $this->showCreateForm = ! $this->showCreateForm;
        $this->resetForm();
    }

    public function createFlashcard(): void
    {
        $this->validate();

        $flashcard = Flashcard::create([
            'user_id'  => Auth::id(),
            'question' => $this->question,
            'answer'   => $this->answer,
        ]);

        $this->deck->flashcards()->attach($flashcard->id);

        $this->resetForm();
        $this->showCreateForm = false;

        session()->flash('success', 'Flashcard created and added to deck.');
    }

    public function startEditing(int $flashcardId): void
    {
        $flashcard = Flashcard::findOrFail($flashcardId);
        abort_if($flashcard->user_id !== Auth::id(), 403);

        $this->editingFlashcardId = $flashcardId;
        $this->question           = $flashcard->question;
        $this->answer             = $flashcard->answer;
        $this->showCreateForm     = false;
    }

    public function updateFlashcard(): void
    {
        $this->validate();

        $flashcard = Flashcard::findOrFail($this->editingFlashcardId);
        abort_if($flashcard->user_id !== Auth::id(), 403);

        $flashcard->update([
            'question' => $this->question,
            'answer'   => $this->answer,
        ]);

        $this->resetForm();
        session()->flash('success', 'Flashcard updated.');
    }

    public function cancelEditing(): void
    {
        $this->resetForm();
    }

    public function deleteFlashcard(int $flashcardId): void
    {
        $flashcard = Flashcard::findOrFail($flashcardId);
        abort_if($flashcard->user_id !== Auth::id(), 403);

        $flashcard->delete();
        session()->flash('success', 'Flashcard deleted.');
    }

    public function removeFromDeck(int $flashcardId): void
    {
        $this->deck->flashcards()->detach($flashcardId);
        session()->flash('success', 'Flashcard removed from deck.');
    }

    private function resetForm(): void
    {
        $this->question           = '';
        $this->answer             = '';
        $this->editingFlashcardId = null;
        $this->resetValidation();
    }

    public function render()
    {
        $flashcards = $this->deck->flashcards()->latest()->get();

        return view('livewire.pages.manage-flashcards', [
            'flashcards' => $flashcards,
        ]);
    }
}
