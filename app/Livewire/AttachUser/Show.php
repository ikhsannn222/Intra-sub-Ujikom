<?php

namespace App\Livewire\AttachUser;

use App\Models\AttachUser;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $attachUserId;
    public $user_id;
    public $project_id;
    public $users;
    public $projects;

    public function mount($attachUserId)
    {
        $this->attachUserId = $attachUserId;

        // Find the AttachUser instance by ID
        $attachUser = AttachUser::findOrFail($this->attachUserId);

        // Set initial values for user and project IDs
        $this->user_id = $attachUser->users_id;
        $this->project_id = $attachUser->projects_id;

        // Fetch users and projects
        $this->users = User::all();
        $this->projects = Project::all();
    }

    public function render()
    {
        return view('livewire.attach-user.show', [
            'users' => $this->users,
            'projects' => $this->projects,
        ]);
    }
}
