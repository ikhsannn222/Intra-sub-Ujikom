<?php

namespace App\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public $permissionId;
    public $permission;
    public $name;

    public function mount($permissionId)
    {
        $this->permission = Permission::find($permissionId);
        $this->name = $this->permission->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $this->permission->update([
            'name' => $this->name
        ]);

         return redirect()->route('permission.index');

    }

    public function render()
    {
        return view('livewire.permission.edit');
    }

}



