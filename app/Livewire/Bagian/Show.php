<?php

namespace App\Livewire\Bagian;

use Livewire\Component;
use App\Models\Bagian; 
use Spatie\Permission\Models\Permission;

class Show extends Component
{
    public $bagian;

    public function mount($id)
    {
        $this->bagian = Bagian::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.bagian.show');
    }
}
