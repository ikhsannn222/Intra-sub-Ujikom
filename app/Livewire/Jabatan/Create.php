<?php

namespace App\Livewire\Jabatan;

use Livewire\Component;
use App\Models\Jabatan;

class Create extends Component
{
    public $name;

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama departemen wajib diisi'
        ]);

        $jabatan = Jabatan::create([
            'name' => $this->name
        ]);

        session()->flash('message', 'Data berhasil ditambahkan.');

        return redirect()->route('jabatan.index');
    }

    public function render()
    {
        return view('livewire.jabatan.create');
    }
}
