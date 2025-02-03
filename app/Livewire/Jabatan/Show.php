<?php

namespace App\Livewire\Jabatan;

use Livewire\Component;
use App\Models\Jabatan;
use Spatie\Permission\Models\Permission;

class Show extends Component
{
    public $jabatan;

    public function mount($id)
    {
        $this->jabatan = Jabatan::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.jabatan.show');
    }
}
