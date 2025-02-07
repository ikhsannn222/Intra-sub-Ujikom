<?php

namespace App\Livewire\Departement;

use Livewire\Component;
use App\Models\Departement;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination; // Diperlukan agar resetPage() bisa digunakan

    public $search = ''; // Beri nilai default agar tidak menyebabkan error

    public function destroy($departementId)
    {
        $departement = Departement::find($departementId);

        if ($departement) {
            $departement->delete();

            // Flash message
            session()->flash('message', 'Data Berhasil Dihapus.');
        }

        // Redirect setelah menghapus (bisa dihilangkan jika hanya ingin refresh Livewire)
        return redirect()->route('departement.index');
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Perbaikan: Dengan WithPagination, ini akan berjalan
    }

    public function render()
    {
        $departements = Departement::where('id', 'like', '%' . $this->search . '%')
        ->orWhere('name', 'like', '%' . $this->search . '%')->paginate(5);

        return view('livewire.departement.index', compact('departements'));
    }
}
