<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class LoginForm extends Form
{
    #[Rule('required|nrp')]
    public string $nrp = '';
    #[Rule('required')]
    public string $password = '';

    public function store()
    {
        $this->validate();
        if (Auth::attempt($this->validate())) {
            return redirect()->route('welcome');
        }

        throw ValidationException::withMessages([
            'nrp' => 'The provided credentialas do not match our records',
        ]);

    }
}
