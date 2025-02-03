<?php

namespace App\Livewire\TaskType;

use Livewire\Component;
use App\Models\TaskType;
class Show extends Component
{
    public $taskTypeId;
    public $taskType;

    public function mount($taskTypeId)
    {
        $this->taskTypeId = $taskTypeId;
        $this->taskType = TaskType::find($taskTypeId);
    }
    public function render()
    {
        return view('livewire.task-type.show', ['tasktype' => $this->taskType]);
    }
}
