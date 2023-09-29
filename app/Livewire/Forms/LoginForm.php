<?php

namespace App\Livewire\Forms;


use App\Http\Controllers\AuthController;
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

        app(AuthController::class->login($credentials));
    }
}
