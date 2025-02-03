<?php

namespace App\Livewire\ProjectStatuses;

use Livewire\Component;
use App\Models\Statuses;
class Show extends Component
{
    public $statusId;
    public $status;

    public function mount($statusId)
    {
        $this->statusId = $statusId;
        $this->status = Statuses::find($statusId);
    }
    public function render()
    {
        return view('livewire.project-statuses.show', ['status' => $this->status]);
    }
}
