<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ChangePassword extends Component
{
    public $old_password;
    public $new_password;
    public $new_password_confirmation;

    public function updatePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ], [
            'old_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->old_password, $user->password)) {
            throw ValidationException::withMessages(['old_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        Auth::logout();
        session()->flash('message', 'Password berhasil diubah. Silakan login kembali!');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.changepassword');
    }
}
