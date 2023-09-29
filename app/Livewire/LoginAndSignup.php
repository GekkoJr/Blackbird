<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class LoginAndSignup extends Component
{
    // variable for checking if you are logging in or signing up
    public $login = true;

    #[On('switchForm')]
    public function switchForm()
    {

    }


    #[Title('Login')]
    public function render()
    {
        return view('livewire.login-and-signup')
            ->layout('components.layouts.welcome');
    }
}
