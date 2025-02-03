<?php

namespace App\Livewire\AttachUser;

use App\Models\AttachUser;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $attachUserId;
    public $user_id;      // Variabel ini harus dipanggil di Blade
    public $project_id;   // Variabel ini harus dipanggil di Blade
    public $users;
    public $projects;

    public function mount($attachUserId)
    {
        $this->attachUserId = $attachUserId;

        // Find the AttachUser instance by ID
        $attachUser = AttachUser::findOrFail($this->attachUserId);

        // Set initial values for the form fields
        $this->user_id = $attachUser->users_id;   // Dapatkan ID pengguna yang ada
        $this->project_id = $attachUser->projects_id; // Dapatkan ID proyek yang ada

        // Fetch users and projects for dropdown options
        $this->users = User::all();
        $this->projects = Project::all();
    }

    public function updatedUserId($value)
    {
        // Update nama pengguna saat memilih
    }

    public function updatedProjectId($value)
    {
        // Update nama proyek saat memilih
    }

    public function update()
    {
        // Validate input data
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        // Find the AttachUser instance to update
        $attachUser = AttachUser::findOrFail($this->attachUserId);

        // Update AttachUser fields
        $attachUser->update([
            'users_id' => $this->user_id,
            'projects_id' => $this->project_id,
        ]);

        // Flash success message
        session()->flash('message', 'Data berhasil diupdate');

        // Redirect to the attach-user index page
        return redirect()->route('attach-user.index');
    }

    public function render()
    {
        return view('livewire.attach-user.edit', [
            'users' => $this->users,
            'projects' => $this->projects,
        ]);
    }
}
