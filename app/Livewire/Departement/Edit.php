<?php

namespace App\Livewire\Departement;

use Livewire\Component;
use App\Models\Departement;

class Edit extends Component
{
    public $departementId;
    public $name;

    public function mount($departementId)
    {
        $departement = Departement::findOrFail($departementId);

        if ($departement) {
            $this->departementId = $departement->id;
            $this->name = $departement->name;
        }
    }

     public function update()
    {
        $this -> validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama departemen wajib diisi'
        ]);

        if($this -> departementId) {
            $departement = Departement::findOrFail($this->departementId);

            if($departement) {
                $departement->update([
                    'name' => $this -> name
                ]);
            }
        }

        session()->flash('message', 'Data berhasil diubah');

        return redirect()->route('departement.index');
    }
    public function render()
    {
        return view('livewire.departement.edit');
    }
}
