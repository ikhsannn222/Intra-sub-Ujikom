<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\Statuses;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $projectId;
    public $name;
    public $description;
    public $owner_id;
    public $status_id;
    public $cover_image;
    public $users;
    public $statuses;
    public $ticket_prefix;

    public function mount($projectId)
    {
        $this->projectId = $projectId;

        // Fetch the project data
        $project = Project::findOrFail($this->projectId);

        // Initialize component properties with project data
        $this->name = $project->name;
        $this->description = $project->description;
        $this->owner_id = $project->owner_id;
        $this->status_id = $project->status_id;
        $this->ticket_prefix = $project->ticket_prefix;

        // Fetch users and statuses for dropdown options
        $this->users = User::all();
        $this->statuses = Statuses::all();
    }

    public function update()
    {
        // Validate input data
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'owner_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'ticket_prefix' => 'required|string|max:255',
            'cover_image' => 'nullable|image', // cover_image is optional for updates
        ]);

        $project = Project::findOrFail($this->projectId);

        if ($this->cover_image) {
            $this->cover_image->storeAs('public/projects', $this->cover_image->hashName());

            $project->update([
                'name' => $this->name,
                'description' => $this->description,
                'owner_id' => $this->owner_id,
                'status_id' => $this->status_id,
                'ticket_prefix' => $this->ticket_prefix,
            ]);
        } else {
            // Update project with the new data
            $project->update([
                'name' => $this->name,
                'description' => $this->description,
                'owner_id' => $this->owner_id,
                'status_id' => $this->status_id,
                'ticket_prefix' => $this->ticket_prefix,
            ]);

        }

        session()->flash('message', 'Data berhasil diupdate');

        return redirect()->route('project.index');
    }

    public function render()
    {
        return view('livewire.project.edit', [
            'users' => $this->users,
            'statuses' => $this->statuses,
        ]);
    }
}
