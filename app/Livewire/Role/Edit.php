<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $name;
    public $permissions = [];
    public $Getpermissions = [];
    public $roleId;

    public function mount($roleId)
    {
        $role = Role::findOrFail($roleId);  // Cari role berdasarkan ID
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->permissions = Permission::all();  // Ambil semua permissions
        $this->Getpermissions = $role->permissions->pluck('id')->toArray();  // Permissions yang sudah di-assign
    }

    public function toggleSelectAllPermissions()
    {
        if (count($this->Getpermissions) === $this->permissions->count()) {
            // Jika semua sudah dicentang, hilangkan centang semua (Uncheck All)
            $this->Getpermissions = [];
        } else {
            // Jika tidak semua dicentang, centang semua (Check All)
            $this->Getpermissions = $this->permissions->pluck('id')->toArray();
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $role = Role::findOrFail($this->roleId);
        $role->name = $this->name;
        $role->save();

        // Sinkronisasi permissions
        $role->syncPermissions($this->Getpermissions);

        session()->flash('message', 'Role berhasil diupdate.');

        return redirect()->route('role.index');
    }

    public function render()
    {
        return view('livewire.role.edit');
    }
}
