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
        <div x-show="toggle" class="centerLogin" x-transition>
        <form wire:submit="save" class="loginForm">
        @csrf
            {{-- If your happiness depends on money, you will never be happy with yourself. --}}
            <label>
            <p>Email</p>
            <input wire:model="form.email" type="email" name="email"></label>
            <div class="error">
            @error('form.email') {{ print '<span class="material-symbols-outlined">error</span>' . $message }}@enderror
            </div>
            <label>
            <p>Password</p>
            <input wire:model="form.password" type="password" name="password"></label>
            <div class="error">
            @error('form.password') {{ print '<span class="material-symbols-outlined">error</span>' . $message }}@enderror
            </div>
            <button type="submit">Login</button>
            <p>Are you new? <span  x-on:click="toggle = ! toggle" class="link">click here</span> </p>
        </form>
        </div>
        HTML;
    }
}
