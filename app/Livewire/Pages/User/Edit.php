<?php

namespace App\Livewire\Pages\User;

use App\Models\Bagian;
use App\Models\Departement;
use App\Models\Jabatan;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

#[Title('Edit User')]
class Edit extends Component
{
    use WithFileUploads;

    public $userId;
    public $name;
    public $nrp;
    public $email;
    public $password;
    public $is_active;
    public $avatar;
    public $role;
    public $departement_id;
    public $bagian_id;
    public $jabatan_id;
    public $departements;
    public $bagians;
    public $jabatans;

    public function mount($userId)
    {
        $user = User::findOrFail($userId);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->nrp = $user->nrp;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->is_active = $user->is_active;
        $this->avatar = $user->avatar;
        $this->role = $user->getRoleNames()->first();
        $this->departement_id = $user->departement_id;
        $this->bagian_id = $user->bagian_id;
        $this->jabatan_id = $user->jabatan_id;

        $this->departements = Departement::all();
        $this->bagians = Bagian::all();
        $this->jabatans = Jabatan::all();

    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'nrp' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
            'is_active' => 'required',
            'avatar' => 'nullable|image|max:1024|mimes:jpeg,png,jpg',
            'role' => 'required|exists:roles,name',
            'departement_id' => 'required|exists:departements,id',
            'bagian_id' => 'required|exists:bagians,id',
            'jabatan_id' => 'required|exists:jabatans,id',
        ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.string' => 'Nama harus berupa teks.',
                'name.max' => 'Nama maksimal 255 karakter.',
                'nrp.required' => 'NRP wajib diisi.',
                'nrp.string' => 'NRP harus berupa teks.',
                'nrp.max' => 'NRP maksimal 255 karakter.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.string' => 'Password harus berupa teks.',
                'password.min' => 'Password harus minimal 6 karakter.',
                'is_active.required' => 'Status wajib dipilih.',
                'avatar.image' => 'File harus berupa gambar.',
                'avatar.max' => 'Ukuran gambar maksimal 1MB.',
                'role.required' => 'Role wajib dipilih.',
                'role.exists' => 'Role tidak valid.',
                'departement_id.required' => 'Departement wajib dipilih.',
                'bagian_id.required' => 'Bagian wajib dipilih.',
                'jabatan_id.required' => 'Jabatan wajib dipilih.',
            ]
        );

        // Ambil pengguna yang akan diupdate
        $user = User::find($this->userId);

        // Update informasi pengguna
        $user->name = $this->name;
        $user->nrp = $this->nrp;
        $user->email = $this->email;

        // Hanya update password jika ada input baru
        if ($this->password) {
            $user->password = bcrypt($this->password);
        }

        $user->is_active = $this->is_active;

        $user->departement_id = $this->departement_id;
        $user->bagian_id = $this->bagian_id;
        $user->jabatan_id = $this->jabatan_id;

        // Update avatar jika ada file baru
        if ($this->avatar) {
            $avatarName = $this->avatar->hashName();
            $this->avatar->storeAs('public/avatars', $avatarName);
            $user->avatar = $avatarName; // Simpan nama file ke database
        }

        // Simpan perubahan
        $user->save();

        // Update role
        $user->syncRoles($this->role); // Menggunakan Spatie

        // Flash message sukses
        session()->flash('message', 'Data berhasil diupdate.');

        // Redirect ke halaman user.index
        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.pages.user.edit', [
            'departements' => $this->departements,
            'bagians' => $this->bagians,
            'jabatans' => $this->jabatans,
        ]);
    }
}
