<?php

namespace App\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public $name;

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Permission::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Permission berhasil ditambahkan.');

        return redirect()->route('permission.index');
    }

    public function render()
    {
        return view('livewire.permission.create');
    }
}
