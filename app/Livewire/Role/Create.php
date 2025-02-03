<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $name;
    public $permissions = [];
    public $Getpermissions = [];

    public function mount()
    {
        $this->permissions = Permission::all();  // Ambil semua permissions
    }

    // Method untuk toggle "Check All"
    public function toggleSelectAllPermissions()
    {
        if (count($this->Getpermissions) === $this->permissions->count()) {
            $this->Getpermissions = [];  // Jika semua sudah dicentang, hilangkan centang semua
        } else {
            $this->Getpermissions = $this->permissions->pluck('id')->toArray();  // Centang semua
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            // Hapus validasi untuk Getpermissions agar tidak wajib
        ]);

        $role = Role::create(['name' => $this->name]);

        // Ambil permissions yang valid dari database
        $validPermissions = Permission::whereIn('id', $this->Getpermissions)->pluck('id')->toArray();

        // Hanya memberikan permissions yang valid ke role
        if (!empty($validPermissions)) {
            $role->givePermissionTo($validPermissions);
        }

        // Set flash message
        session()->flash('message', 'Data berhasil ditambahkan.');

        return redirect()->route('role.index');
    }

    public function render()
    {
        return view('livewire.role.create');
    }
}
