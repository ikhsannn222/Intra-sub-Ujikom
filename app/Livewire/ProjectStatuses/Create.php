<?php

namespace App\Livewire\ProjectStatuses;

use App\Models\Statuses;
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

        $status = Statuses::create([
            'name' => $this->name,
            'color' => $this->color,
            'is_default' => $this->is_default,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan.');
        return redirect()->route('project-statuses.index');
    }

    public function render()
    {
        return view('livewire.project-statuses.create');
    }
}
