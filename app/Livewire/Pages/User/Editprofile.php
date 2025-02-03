<?php
namespace App\Livewire\Pages\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $avatar; // This will hold the uploaded file// Holds the path to the current avatar

    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'avatar' => 'nullable|image', // Avatar is optional
        ]);

        $user = auth()->user();
        if ($this->avatar) {
            // Simpan file avatar dan ambil path-nya
            $avatarPath = $this->avatar->storeAs('public/avatars/', $this->avatar->hashName());

            // Update avatar pengguna di database
            $user->update([
                'avatar' => str_replace('public/', '', $avatarPath),
            ]);
        }

        // Update nama dan email (selalu di-update meskipun avatar tidak diubah)
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Update Profile Successfully.');
        return redirect()->route('profile.edit');
    }

    public function render()
    {
        return view('livewire.pages.user.editprofile', [
            'user' => auth()->user(),
        ]
        );
    }
}
