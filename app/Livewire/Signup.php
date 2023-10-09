<?php

namespace App\Livewire;

use App\Livewire\Forms\SignupForm;
use Livewire\Component;

class Signup extends Component
{
    public SignupForm $form;

    public function switchForm()
    {
        $this->dispatch('switchForm');
    }

    public function signup()
    {
        $this->form->signup();
    }

    public function render()
    {
        return <<<'HTML'
        <form wire:submit="signup">
            {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
            @csrf
            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="password" name="password">
            <input type="email" placeholder="email" name="email">
            <input type="password" placeholder="password verify" name="verify_password"
            <button type="submit">Signup</button>
        </form>
        HTML;
    }
}
