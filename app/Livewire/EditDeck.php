<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditDeck extends Component
{
    public string $deck = '';

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.edit-deck');
    }
}
