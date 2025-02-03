<?php

namespace App\Livewire\TaskStatus;

use App\Models\TaskStatus;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $color;
    public $is_default = true;
    public $order;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'color' => 'required',
        ]);

        $taskStatus = TaskStatus::create([
            'name' => $this->name,
            'color' => $this->color,
            'is_default' => $this->is_default,
            'order' => $this->order,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan.');
        return redirect()->route('task-status.index');
    }


    public function render()
    {
        return view('livewire.task-status.create');
    }
}
