<?php

namespace App\Livewire\Bagian;
use Spatie\Permission\Models\Permission;

use Livewire\Component;
use App\Models\Bagian;
use Livewire\WithPagination;

class Index extends Component
{
    public $search;

    use WithPagination;

    /**
     * destroy function
     */
    public function destroy($id)
    {
        $bagian = Bagian::findOrFail($id);

        if ($bagian) {
            $bagian->delete();
        }
        session()->flash('message', 'Data Berhasil Dihapuss.');

        return redirect()->route('bagian.index');
    }

    public function render()
    {
        return view('livewire.bagian.index', [
            'bagians' => Bagian::where('name', 'like', '%'.$this->search.'%')->paginate(5)
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
