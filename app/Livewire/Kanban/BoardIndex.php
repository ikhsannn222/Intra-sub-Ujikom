<?php

namespace App\Livewire\Kanban;

use App\Models\AttachUser;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BoardIndex extends Component
{
    public $selectedProject;

    public function updatedSelectedProject($projectId)
    {
        if ($projectId) {
            // Redirect ke halaman kanban berdasarkan projectId
            return redirect()->route('kanban.index', ['projectId' => $projectId]);
        }
    }

    public function render()
    {
        $user = Auth::user();

        if ($user->hasRole('superadmin')) {
            $project = Project::all();
        } else {
            $attachUser = AttachUser::where('users_id', $user->id)->pluck('projects_id');
            $project = Project::whereIn('id', $attachUser)->get();

        }

        // dd($project);
        return view('livewire.kanban.board-index', [
            'projects' => $project,
        ]);
    }
}
