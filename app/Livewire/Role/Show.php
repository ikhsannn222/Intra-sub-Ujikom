<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Show extends Component
{
    public $roleId;
    public $role;

    public function mount($roleId)
    {
        $this->roleId = $roleId;
        $this->role = Role::findOrFail($this->roleId);
    }

    public function render()
    {
        // Mengambil semua permission yang ada
        $permissions = Permission::all();

        // Return the view with the role and permissions data
        return view('livewire.role.show', [
            'role' => $this->role,
            'permissions' => $permissions, // Tambahkan ini
        ]);
    }
}
