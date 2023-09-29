<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Form;

class LoginForm extends Form
{
    #[Rule('required|email')]
    public $email;

    #[Rule('required')]
    public $password;

    public function Login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if(Auth::attempt($credentials)) {
            return redirect(route('home'));
        } else {
            return back()->withErrors([
                'error' => 'Invalid credentials'
            ]);
        }
    }

    public function switchForm()
    {
        dispatch('switchForm');
    }
}
