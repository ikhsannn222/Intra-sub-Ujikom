<?php

namespace App\Livewire\TaskType;

use App\Models\TaskType;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search;

    use WithPagination;

    public function destroy($taskTypeId)
    {
        $taskType = TaskType::find($taskTypeId);

        if ($taskType) {
            $taskType->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('task-type.index');
    }

    public function render()
    {
        return view('livewire.task-type.index', [
            'taskType' => TaskType::where('name', 'like', '%'.$this->search.'%')->paginate(5),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
