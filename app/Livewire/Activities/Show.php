<?php

namespace App\Livewire\Activities;

use App\Models\Activities;
use Livewire\Component;

class Show extends Component
{
    public $aktivitasId;
    public $aktivitas;

    public function mount($aktivitasId)
    {
        $this->aktivitasId = $aktivitasId;
        $this->aktivitas = Activities::find($aktivitasId);
    }
    public function render()
    {
        return view('livewire.activities.show', ['aktivitas' => $this->aktivitas]);
    }
}
