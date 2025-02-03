<?php

namespace App\Livewire\Departement;

use Livewire\Component;
use App\Models\Departement;

class Create extends Component
{
    public $name;

    public function store()
    {
        $this->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama departemen wajib diisi'
        ]);

        $departement = Departement::create([
            'name' => $this->name
        ]);

        session()->flash('message', 'Data berhasil ditambah');

        return redirect()->route('departement.index');
    }

    public function render()
    {
        return view('livewire.departement.create');
    }
}
