<?php

namespace App\Livewire\TaskStatus;

use Livewire\Component;
use App\Models\TaskStatus;
class Show extends Component
{
    public $taskStatusId;
    public $taskStatus;

    public function mount($taskStatusId)
    {
        $this->taskStatusId = $taskStatusId;
        $this->taskStatus = TaskStatus::find($taskStatusId);
    }
    public function render()
    {
        return view('livewire.task-status.show', ['taskStatus' => $this->taskStatus]);
    }
}
