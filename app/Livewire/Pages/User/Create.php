<?php

namespace App\Livewire\Pages\User;

use App\Attributes\Title;
use App\Models\User;
use App\Models\Bagian;
use App\Models\Departement;
use App\Models\Jabatan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

#[Title('Create User')]
class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $nrp;
    public $email;
    public $password;
    public $is_active;
    public $avatar;
    public $role;
    public $bagian_id;
    public $jabatan_id;
    public $departement_id;

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'nrp' => 'required|string|max:255|unique:users,nrp',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'is_active' => 'required',
            'avatar' => 'nullable|image|max:1024|mimes:jpeg,png,jpg',
            'role' => 'required|exists:roles,name',
            'departement_id' => 'required|exists:departements,id',
            'bagian_id' => 'required|exists:bagians,id',
            'jabatan_id' => 'required|exists:jabatans,id',
        ], [

            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'nrp.required' => 'NRP wajib diisi.',
            'nrp.string' => 'NRP harus berupa teks.',
            'nrp.unique' => 'NRP sudah terdaftar.',
            'nrp.max' => 'NRP maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password harus minimal 6 karakter.',
            'is_active.required' => 'Status wajib dipilih.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.max' => 'Ukuran gambar maksimal 1MB.',
            'role.required' => 'Role wajib dipilih.',
            'role.exists' => 'Role tidak valid.',
            'departement_id.required' => 'Departement wajib dipilih.',
            'departement_id.exists' => 'Departement tidak valid.',
            'bagian_id.required' => 'Bagian wajib dipilih.',
            'bagian_id.exists' => 'Bagian tidak valid.',
            'jabatan_id.required' => 'Jabatan wajib dipilih.',
            'jabatan_id.exists' => 'Jabatan tidak valid.',
        ]);

        // Tentukan nama file
        $avatarName = $this->avatar->hashName();

        // Simpan avatar dengan storeAs
        $this->avatar->storeAs('public/avatars', $avatarName);

        // Simpan user ke database
        $user = User::create([
            'name' => $this->name,
            'nrp' => $this->nrp,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'is_active' => $this->is_active,
            'avatar' => $avatarName,
            'departement_id' => $this->departement_id,
            'bagian_id' => $this->bagian_id,
            'jabatan_id' => $this->jabatan_id, // Simpan nama file ke database
        ]);

        $user->assignRole($this->role);

        // Flash message sukses
        session()->flash('message', 'Data berhasil ditambahkan.');

        // Redirect ke halaman user.index
        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.pages.user.create', [
            'departements' => Departement::all(),
            'bagians' => Bagian::all(),
            'jabatans' => Jabatan::all(),
        ]);
    }
}
