<?php

namespace App\Livewire\Tasks;

use App\Models\Tasks;
use App\Models\Project;
use App\Models\User;
use App\Models\TaskStatus;
use App\Models\TaskType;
use App\Models\Priorities;
use Livewire\Component;

class Edit extends Component
{
    public $task;
    public $name;
    public $content;
    public $owner_id;
    public $responsible_id;
    public $status_id;
    public $project_id;
    public $type_id;
    public $priority_id;
    public $code;
    public $order;
    public $estimation;

    // Method untuk inisialisasi data dari task yang akan diedit
    public function mount($tasksId)
    {
        $this->task = Tasks::findOrFail($tasksId);
        $this->name = $this->task->name;
        $this->content = $this->task->content;
        $this->owner_id = $this->task->owner_id;
        $this->responsible_id = $this->task->responsible_id;
        $this->status_id = $this->task->status_id;
        $this->project_id = $this->task->project_id;
        $this->type_id = $this->task->type_id;
        $this->priority_id = $this->task->priority_id;
        $this->code = $this->task->code;
        $this->order = $this->task->order;
        $this->estimation = $this->task->estimation;
    }

    // Method untuk memperbarui data
    public function update()
    {
        // Validasi input
        $this->validate([
            'name' => 'required|string|max:255',
            'content' => 'required',
            'owner_id' => 'required|exists:users,id',
            'responsible_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'project_id' => 'required|exists:projects,id',
            'type_id' => 'required|exists:task_types,id',
            'priority_id' => 'required|exists:priorities,id',
            'code'=> 'required',
            'order'=> 'required',
            'estimation'=> 'required',
        ]);

        // Memperbarui data task di database
        $this->task->update([
            'name' => $this->name,
            'content' => $this->content,
            'owner_id' => $this->owner_id,
            'responsible_id' => $this->responsible_id,
            'status_id' => $this->status_id,
            'project_id' => $this->project_id,
            'type_id' => $this->type_id,
            'priority_id' => $this->priority_id,
            'code' => $this->code,
            'order' => $this->order,
            'estimation' => $this->estimation,
        ]);

        // Menampilkan pesan sukses
        session()->flash('message', 'Data berhasil diperbarui');

        // Redirect ke halaman indeks
        return redirect()->route('tasks.index');
    }

    // Method untuk render tampilan
    public function render()
    {
        return view('livewire.tasks.edit', [
            'users' => User::all(),
            'statuses' => TaskStatus::all(),
            'projects' => Project::all(),
            'taskType' => TaskType::all(),
            'priorities' => Priorities::all(),
        ]);
    }
}
