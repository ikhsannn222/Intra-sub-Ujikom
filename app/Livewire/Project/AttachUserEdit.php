<?php

namespace App\Livewire\Project;

use App\Models\AttachUser;
use App\Models\User;
use Livewire\Component;

class AttachUserEdit extends Component
{
    public $projects_id;
    public $attachUserId;
    public $users_id;
    public $users;
    public $attachUser;

    public function mount($projectId, $attachUserId)
    {
        $this->projects_id = $projectId;

        $this->attachUser = AttachUser::where('projects_id', $this->projects_id)
                                      ->where('id', $attachUserId)
                                      ->first();

        if (!$this->attachUser) {
            session()->flash('error', 'Attach User not found.');
            return redirect()->route('project.show', ['projectId' => $this->projects_id]);
        }

        $attach_user = AttachUser::where("projects_id", $this->projects_id)->pluck('users_id')->all();
        $this->users = User::whereNotIn('id', $attach_user)->get();

        $this->users_id = $this->attachUser->users_id;
    }

    public function update()
    {
        if (!$this->users_id) {
            session()->flash('error', 'Please select a user.');
            return;
        }

        $this->attachUser->update([
            'users_id' => $this->users_id,
        ]);

        session()->flash('message', 'Attach User updated successfully.');
        return redirect()->route('project.show', ['projectId' => $this->projects_id]);
    }

    public function render()
    {
        return view('livewire.project.attach-user-edit', [
            'users' => $this->users,
        ]);
    }
}
