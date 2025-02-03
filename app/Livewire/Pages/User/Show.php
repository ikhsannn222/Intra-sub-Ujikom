<?php

namespace App\Livewire\Pages\User;

use Livewire\Component;
use Livewire\Atrributes\Title;
use App\Models\User;
use App\Models\Bagian;
use App\Models\Departement;
use App\Models\Jabatan;

#[Title('User Detail')]
class Show extends Component
{
    public $userId;
    public $user;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->user = User::with('departement', 'bagian', 'jabatan')->findOrFail($this->userId);
    }
    public function render()
    {
        return view('livewire.pages.user.show', ['user' => $this->user]);
    }
}
