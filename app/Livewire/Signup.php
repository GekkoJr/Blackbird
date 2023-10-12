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

    //I am never making such a large inline componenent ever again :(
    public function render()
    {
        return <<<'HTML'
        <div class="centerLogin">
        <form wire:submit="signup" class="loginForm">
            {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
            @csrf
            <label>
            <p>Username</p>
            <input wire:model="form.username" type="text" name="username"></label>
            <div class="error">
            @error('form.username') {{ print '<img src="/icons/error.svg" alt="errorIcon">' . $message }} @enderror
            </div>
            <label>
            <p>Email</p>
            <input wire:model="form.email" type="email" name="email"></label>
            <div class="error">
            @error('form.email') {{ print '<img src="/icons/error.svg" alt="errorIcon">' . $message }}@enderror
            </div>
            <label>
            <p>Password</p>
            <input wire:model="form.password" type="password" name="password"></label>
            <div class="error">
            @error('form.password') {{ print '<img src="/icons/error.svg" alt="errorIcon">' . $message}}@enderror
            </div>
            <label>
            <p>Verify password</p>
            <input wire:model="form.verify_password" type="password" name="verify_password"></label>
            <div class="error">
            @error('form.error') {{ print '<img src="/icons/error.svg" alt="errorIcon">' . $message}}@enderror
            </div>
            <button type="submit">Login</button>
            <p>Alredy have an acoount? <span class="link" wire:click="switchForm">click here</span> </p>
        </form>
        </div>
        HTML;
    }
}
