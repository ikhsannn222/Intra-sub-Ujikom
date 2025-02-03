<?php

namespace App\Livewire\AttachUser;

use App\Models\AttachUser;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $users_id; // Variabel untuk menyimpan ID pengguna
    public $projects_id; // Variabel untuk menyimpan ID proyek

    // Method untuk menyimpan data
    public function store()
    {
        // Validasi input
        $this->validate([
            'users_id' => 'required|exists:users,id',
            'projects_id' => 'required|exists:projects,id',
        ]);

        // Menyimpan data ke dalam database
        AttachUser::create([
            'users_id' => $this->users_id,
            'projects_id' => $this->projects_id,
        ]);

        // Menampilkan pesan sukses
        session()->flash('message', 'Data Berhasil disimpan');

        // Reset form
        $this->reset(['users_id', 'projects_id']);

        // Redirect ke halaman indeks
        return redirect()->route('attach-user.index');
    }

    // Method untuk render tampilan
    public function render()
    {
        return view('livewire.attach-user.create', [
            'users' => User::all(), // Mengambil semua pengguna
            'projects' => Project::all(), // Mengambil semua proyek
        ]);
    }
}
