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
        <form wire:submit="signup" class="loginForm">
            {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
            @csrf
            <label>
            <p>Username</p>
            <input wire:model="form.username" type="text" name="username"></label>
            @error('form.username') {{ $message}}@enderror
            <label>
            <p>Email</p>
            <input wire:model="form.email" type="email" name="email"></label>
            @error('form.email') {{ $message}}@enderror
            <label>
            <p>Password</p>
            <input wire:model="form.password" type="password" name="password"></label>
            @error('form.password') {{ $message}}@enderror
            <label>
            <p>Verify password</p>
            <input wire:model="form.verify_password" type="password" name="verify_password"></label>
            @error('form.error') {{ $message}}@enderror
            <button type="submit">Login</button>
            <p wire:click="switchForm">Alredy have an acoount? click here</p>
        </form>
        HTML;
    }
}
