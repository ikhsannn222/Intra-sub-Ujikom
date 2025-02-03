<?php

namespace App\Livewire\Tasks;

use App\Models\Tasks;
use App\Models\Project;
use App\Models\User;
use App\Models\TaskStatus;
use App\Models\TaskType;
use App\Models\Priorities;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{
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
    public $start_date;
    public $end_date;

    // is_default
    public function mount()
    {
        // Set default status, project, type, dan priority berdasarkan is_default = true
        $this->status_id = TaskStatus::where('is_default', true)->value('id');
        $this->type_id = TaskType::where('is_default', true)->value('id');
        $this->priority_id = Priorities::where('is_default', true)->value('id');
    }

    // Method untuk menyimpan data
    public function store()
    {
        // Validasi input
        $this->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'owner_id' => 'required|exists:users,id',
            'responsible_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'project_id' => 'required|exists:projects,id',
            'type_id' => 'required|exists:task_types,id',
            'priority_id' => 'required|exists:priorities,id',
            'code'=> 'required',
            'order'=> 'required',
            'estimation'=> 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Menyimpan data ke dalam database
        $task = Tasks::create([
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        // Menampilkan pesan sukses
        session()->flash('message', 'Data Berhasil disimpan');

        // Reset form
        $this->reset(['owner_id','responsible_id','status_id','project_id','type_id','priority_id', 'start_date', 'end_date']);

        // Redirect ke halaman indeks
        return redirect()->route('tasks.index');
    }

    public function saveTask()
    {
        // Validasi untuk tanggal
        $this->validate([
            'editedTask.start_date' => 'nullable|date',
            'editedTask.end_date' => 'nullable|date|after_or_equal:editedTask.start_date',
        ]);

        // Pastikan tanggal start_date dan end_date adalah objek Carbon jika ada
        if (isset($this->editedTask['start_date'])) {
            $this->editedTask['start_date'] = Carbon::parse($this->editedTask['start_date']);
        }

        if (isset($this->editedTask['end_date'])) {
            $this->editedTask['end_date'] = Carbon::parse($this->editedTask['end_date']);
        }

        $task = Tasks::find($this->editingTaskId);

        if ($task) {
            $task->update($this->editedTask);
        }

        $this->resetEdit();
    }

    // Method untuk render tampilan
    public function render()
    {
        return view('livewire.tasks.create', [
            'users' => User::all(),
            'statuses'=> TaskStatus::all(),
            'projects' => Project::all(),
            'taskType' => TaskType::all(),
            'priorities' => Priorities::all(),
        ]);
    }
}
