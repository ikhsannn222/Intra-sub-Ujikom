<?php

namespace App\Livewire\TaskStatus;

use App\Models\TaskStatus;
use Livewire\Component;

class Edit extends Component
{
    public $taskStatusId;
    public $name;
    public $color;
    public $is_default;
    public $order;

    public function mount($taskStatusId)
    {
        $taskStatus = TaskStatus::find($taskStatusId);

        if ($taskStatus) {
            $this->taskStatusId = $taskStatus->id;
            $this->name = $taskStatus->name;
            $this->color = $taskStatus->color;
            $this->is_default = (bool) $taskStatus->is_default;
            $this->order = $taskStatus->order;
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'color' => 'required',
        ]);

        if ($this->taskStatusId) {
            $taskStatus = TaskStatus::find($this->taskStatusId);

            if ($taskStatus) {
                $taskStatus->update([
                    'name' => $this->name,
                    'color' => $this->color,
                    'is_default' => $this->is_default,
                    'order' => $this->order,
                ]);
            };
        }

        session()->flash('message', 'Data berhasil diubah.');
        return redirect()->route('task-status.index');
    }

    public function render()
    {
        return view('livewire.task-status.edit');
    }
}
