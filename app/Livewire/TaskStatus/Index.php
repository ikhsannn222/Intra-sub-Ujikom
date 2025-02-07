<?php

namespace App\Livewire\TaskStatus;

use Livewire\Component;
use App\Models\TaskStatus;
use Livewire\WithPagination;

class Index extends Component
{
    public $search;

    use WithPagination;


    public function destroy($taskStatusId)
    {
        $taskStatus = TaskStatus::find($taskStatusId);

        if ($taskStatus) {
            $taskStatus->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('task-status.index');
    }


    public function render()
    {
        return view('livewire.task-status.index', [
            'taskStatus' => TaskStatus::where('id', 'like', '%'.$this->search.'%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->orWhere('color', 'like', '%' . $this->search . '%')->paginate(5),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
