<?php

namespace App\Livewire\Tasks;

use App\Models\Tasks;
use App\Models\Project;
use App\Models\User;
use App\Models\Statuses;
use App\Models\TaskType;
use App\Models\Priorities;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    public $search;

    use WithPagination;

    public function destroy($tasksId)
    {
        $tasks = Tasks::find($tasksId);

        if ($tasks) {
            $tasks->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('tasks.index');
    }

    public function render()
{
    return view('livewire.tasks.index', [
        'tasks' => Tasks::with(['owner', 'responsible', 'status', 'project', 'type', 'priority'])->where('name','like','%'.$this->search.'%')->latest()->paginate(5)
    ]);
}

    public function updatingSearch()
    {
        $this->resetPage();
    }

}
