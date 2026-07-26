<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MyDecks extends Component
{
    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.my-decks');
    }
}
