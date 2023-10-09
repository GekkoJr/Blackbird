<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class App extends Component
{
    #[Title('Blackbird')]
    public function render()
    {
        return view('livewire.app');
    }
}
