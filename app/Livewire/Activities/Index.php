<?php

namespace App\Livewire\Activities;

use App\Models\Activities;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search;

    use WithPagination;

    public function destroy($aktivitasId)
    {
        $aktivitas = Activities::find($aktivitasId);

        if ($aktivitas) {
            $aktivitas->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('activities.index');
    }

    public function render()
    {
        return view('livewire.activities.index', [
            'aktivitas' => Activities::where('name', 'like', '%'.$this->search.'%')->paginate(5),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

}
