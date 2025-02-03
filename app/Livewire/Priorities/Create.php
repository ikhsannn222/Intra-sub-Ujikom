<?php

namespace App\Livewire\Priorities;

use App\Models\priorities;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $color;
    public $is_default = true;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'color' => 'required',
        ]);

        $status = Priorities::create([
            'name' => $this->name,
            'color' => $this->color,
            'is_default' => $this->is_default,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan.');
        return redirect()->route('priorities.index');
    }

    public function render()
    {
        return view('livewire.priorities.create');
    }
}
