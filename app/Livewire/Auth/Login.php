<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Login extends Component
{

    #[Title('Login')]
    public $form = [
        'nrp'=>'',
        'password' => '',
    ];
     public $showPassword = false;

    #[Layout('components.layouts.app-auth')]
    public function login()
    {
        // Validasi data sebelum login
        $this->validate([
            'form.nrp' => 'required',
            'form.password' => 'required|min:6',
        ]);

        

        // Memeriksa apakah NRP terdaftar
        $user = User::where('nrp', $this->form['nrp'])->first();
        if (!$user) {
            session()->flash('error', 'NRP tidak terdaftar.');
            return;
        }
        if (auth()->attempt(['nrp' => $this->form['nrp'], 'password' => $this->form['password']])) {
            return redirect()->route('welcome');
        } else {
            session()->flash('error', 'Password salah.');
        }
    }

     public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function render()
    {
        return view('livewire.auth.login', [
            'showPassword' => $this->showPassword
        ]);
    }
}
