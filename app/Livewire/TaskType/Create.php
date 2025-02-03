<?php

namespace App\Livewire\TaskType;

use App\Models\TaskType;
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

        $taskType = TaskType::create([
            'name' => $this->name,
            'color' => $this->color,
            'is_default' => $this->is_default,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan.');
        return redirect()->route('task-type.index');
    }

    public function render()
    {
        return view('livewire.task-type.create');
    }
}
