<?php

namespace App\Livewire\Project;

use App\Models\AttachUser;
use Livewire\Component;
use App\Models\User;

class AttachUserIndex extends Component
{
    public $projects_id;
    public $users_id;
    public $users;

    public function mount($projectId)
    {
        $this->projects_id = $projectId;

        // get users yang belum terdaftar
        $attach_user = AttachUser::where("projects_id", $this->projects_id)->pluck('users_id')->all();
        $this->users = User::whereNotIn('id', $attach_user)->get();
    }

    public function store()
    {
        AttachUser::create([
            'users_id' => $this->users_id,
            'projects_id' => $this->projects_id,
        ]);

        session()->flash('message', 'Pengguna berhasil dilampirkan ke proyek.');
        return redirect()->route('project.show', ['projectId' => $this->projects_id]);
    }

    public function render()
    {
        return view('livewire.project.attach-user-index', [
            'users' => $this->users,
            'attachedUsers' => AttachUser::where('projects_id', $this->projects_id)->get(),
        ]);
    }
}
