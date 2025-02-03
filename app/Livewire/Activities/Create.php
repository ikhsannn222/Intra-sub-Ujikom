<?php

namespace App\Livewire\Activities;

use App\Models\Activities;
use Livewire\Component;

class Create extends Component
{   public $name;
    public $description;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $aktivitas = Activities::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan.');
        return redirect()->route('activities.index');
    }

    public function render()
    {
        return view('livewire.activities.create');
    }
}
