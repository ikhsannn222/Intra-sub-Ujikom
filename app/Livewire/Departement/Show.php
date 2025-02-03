<?php

namespace App\Livewire\Departement;

use Livewire\Component;
use App\Models\Departement;
use Livewire\Atrributes\Title;

#[Title('Detail Departement')]
class Show extends Component
{
    public $departementId;
    public $departement;

    public function mount($departementId)
    {
        $this->departementId = $departementId;
        $this->departement = Departement::findOrFail($this->departementId);
    }

    public function render()
    {
        return view('livewire.departement.show', ['departement' => $this->departement]);
    }
}
