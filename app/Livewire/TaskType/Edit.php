<?php

namespace App\Livewire\TaskType;

use App\Models\TaskType;
use Livewire\Component;

class Edit extends Component
{
    public $taskTypeId;
    public $name;
    public $color;
    public $is_default;

    public function mount($taskTypeId)
    {
        $taskType = TaskType::find($taskTypeId);

        if ($taskType) {
            $this->taskTypeId = $taskType->id;
            $this->name = $taskType->name;
            $this->color = $taskType->color;
            $this->is_default = (bool) $taskType->is_default;
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'color' => 'required',
        ]);

        if ($this->taskTypeId) {
            $taskType = TaskType::find($this->taskTypeId);

            if ($taskType) {
                $taskType->update([
                    'name' => $this->name,
                    'color' => $this->color,
                    'is_default' => $this->is_default,
                ]);
            };
        }

        session()->flash('message', 'Data berhasil diubah.');
        return redirect()->route('task-type.index');
    }

    public function render()
    {
        return view('livewire.task-type.edit');
    }
}
