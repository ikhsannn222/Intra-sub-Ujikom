<?php

namespace App\Livewire\Departement;

use Livewire\Component;
use App\Models\Departement;
use Livewire\WithPagination;

class Index extends Component
{
    public $search;

    public function destroy($departementId)
    {
        $departement = Departement::find($departementId);

        if ($departement) {
            $departement->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('departement.index');
    }

    public function render()
    {
        return view('livewire.departement.index', [
            'departements' => Departement::where('name', 'like', '%'.$this->search.'%')->paginate(5)
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
