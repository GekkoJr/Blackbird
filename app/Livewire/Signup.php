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
            <input wire:model="form.username" type="text" placeholder="username" name="username">
            @error('form.username') {{ $message}}@enderror
            <input wire:model="form.password" type="password" placeholder="password" name="password">
            @error('form.password') {{ $message}}@enderror
            <input wire:model="form.email" type="email" placeholder="email" name="email">
            @error('form.email') {{ $message}}@enderror
            <input wire:model="verify_password" type="password" placeholder="password verify" name="verify_password">
            @error('form.error') {{ $message}}@enderror
            <button type="submit">Login</button>
            <p wire:click="switchForm">Alredy have an acoount? click here</p>
        </form>
        HTML;
    }
}
