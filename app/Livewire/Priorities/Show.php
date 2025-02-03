<?php

namespace App\Livewire\Priorities;

use Livewire\Component;
use App\Models\Priorities;
class Show extends Component
{
    public $prioritasId;
    public $prioritas;

    public function mount($prioritasId)
    {
        $this->prioritasId = $prioritasId;
        $this->prioritas = Priorities::find($prioritasId);
    }
    public function render()
    {
        return view('livewire.priorities.show', ['prioritas' => $this->prioritas]);
    }
}
