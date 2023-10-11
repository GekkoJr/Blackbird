<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    public function save() {
        $this->form->login();
    }

    public function switchForm()
    {
        $this->dispatch('switchForm');
    }

    public function render()
    {
        return <<<'HTML'
        <div class="centerLogin">
        <form wire:submit="save" class="loginForm">
        @csrf
            {{-- If your happiness depends on money, you will never be happy with yourself. --}}
            <label>
            <p>Email</p>
            <input wire:model="form.email" type="email" name="email"></label>

            @error('form.email') {{ $message }}@enderror
            <label>
            <p>Password</p>
            <input wire:model="form.password" type="password" name="password"></label>
            @error('form.password') {{ $message }}@enderror
            <button type="submit">Login</button>
            <p wire:click="switchForm">Are you new? click here</p>
        </form>
        </div>
        HTML;
    }
}
