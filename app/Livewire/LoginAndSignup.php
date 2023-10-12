<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class LoginAndSignup extends Component
{
    #[Title('Login')]
    public function render()
    {
        return view('livewire.login-and-signup')
            ->layout('components.layouts.welcome');
    }
}
