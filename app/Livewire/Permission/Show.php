<?php

namespace App\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Show extends Component
{
    public $permission;

    public function mount($id)
    {
        $this->permission = Permission::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.permission.show');
    }
}
