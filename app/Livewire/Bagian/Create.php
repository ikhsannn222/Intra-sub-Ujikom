<?php

namespace App\Livewire\Bagian;

use App\Models\Bagian;
use Spatie\Permission\Models\Permission;
use Livewire\Component;

class Create extends Component
{
    public $name;

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Bagian::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan.');

        return redirect()->route('bagian.index');
    }

    public function render()
    {
        return view('livewire.bagian.create');
    }
}
