<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Form;

class SignupForm extends Form
{
    #[Rule('required|alpha_num|min:3|max:50|unique:users,username')]
    public $username;

    #[Rule('required|email|unique:users,email')]
    public $email;

    #[Rule('required|min:8|max:100')]
    public $password;

    #[Rule('required')]
    public $verify_password;

    public function Signup()
    {
        $this->validate();

        if ($this->password !== $this->verify_password) {
            return back()->with('password_match', 'passwords does not match');
        }
        $this->originalPassword = $this->password;

        $this->password = Hash::make($this->password);

        $user = new User;

        $user->username = $this->username;
        $user->password = $this->password;
        $user->email = $this->email;
        $user->save();

        $credentials = [
            'email' => $this->email,
            'password' => $this->originalPassword,
        ];

        if (Auth::attempt($credentials)) {
            return redirect(route('home'));
        }

        return back();

    }
}
