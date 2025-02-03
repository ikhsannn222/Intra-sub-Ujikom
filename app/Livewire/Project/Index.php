<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\Statuses;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search;
    public $owners;
    public $statuses;

    public $selectedStatuses = '';
    public $selectedOwners = '';

    use WithPagination;

    public function destroy($projectId)
    {
        $project = Project::find($projectId);

        if ($project) {
            $project->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('project.index');
    }

    public function mount()
    {
        $this->owners = User::all();
        $this->statuses = Statuses::all();
    }

    public function render()
    {
        $query = Project::with(['owner', 'status'])
            ->where('name', 'like', '%' . $this->search . '%');
        if(!empty($this->selectedStatuses)) {
            $query->where('status_id', $this->selectedStatuses);
        }
        if(!empty($this->selectedOwners)) {
            $query->where('owner_id', $this->selectedOwners);
        }
        $projects = $query->latest()->paginate(5);
        // $project = Project::with(['owner', 'status'])->where('name','like','%'.$this->search.'%')->latest()->paginate(5);
        return view('livewire.project.index', [
            'projects' => $projects,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
