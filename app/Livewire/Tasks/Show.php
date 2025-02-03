<?php
namespace App\Livewire\Tasks;

use App\Models\Tasks;
use App\Models\Project;
use App\Models\User;
use App\Models\TaskStatus;
use App\Models\TaskType;
use App\Models\Priorities;
use Livewire\Component;
use Carbon\Carbon;

class Show extends Component
{
    public $task;

    // Method for initializing task data based on ID
    public function mount($tasksId)
    {
        // Load task with relationships
        $this->task = Tasks::with(['owner', 'responsible', 'status', 'project', 'type', 'priority'])
                           ->findOrFail($tasksId);

        // Format the start_date and end_date using Carbon
        $this->task->start_date = $this->task->start_date ? Carbon::parse($this->task->start_date)->format('d M Y') : 'N/A';
        $this->task->end_date = $this->task->end_date ? Carbon::parse($this->task->end_date)->format('d M Y') : 'N/A';
    }

    // Method to render the view
    public function render()
    {
        return view('livewire.tasks.show', [
            'task' => $this->task,
        ]);
    }
}

