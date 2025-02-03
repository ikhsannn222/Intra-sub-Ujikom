<?php

namespace App\Livewire\Project;

use App\Models\AttachUser;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $users;
    public $projectId;
    public $project;
    public $user_id;
    public $attachUserId;
    public $search = ''; // Variabel pencarian

    protected $updatesQueryString = ['search']; // Update query string untuk pagination

    public function mount($projectId, $attachUserId = null)
    {
        $this->projectId = $projectId;
        $this->attachUserId = $attachUserId;

        $this->project = Project::with('owner', 'status')->findOrFail($this->projectId);
        $this->users = User::all();
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset halaman pagination jika pencarian berubah
    }

    public function destroy($attachUserId)
    {
        $attachment = AttachUser::find($attachUserId);

        if ($attachment) {
            $attachment->delete();
            session()->flash('message', 'Data Berhasil Dihapus.');
        } else {
            session()->flash('error', 'Attachment not found.');
        }
    }

    public function render()
    {
        $attachUser = AttachUser::where('projects_id', $this->projectId)
            ->whereHas('user', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%'); // Tambahkan pencarian berdasarkan nama user
            })
            ->with('user')
            ->paginate(10);

        return view('livewire.project.show', [
            'project' => $this->project,
            'attachUser' => $attachUser,
        ]);
    }
}
