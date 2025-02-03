<?php

namespace App\Livewire\Pages\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('User')]
class Index extends Component
{
    public $search;

    use WithPagination;

    /**
     * destroy function
     */
    public function destroy($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('user.index');
    }


    public function render()
    {
        $users = User::where('name','like','%'.$this->search.'%')->paginate(20);

        return view('livewire.pages.user.index', [
            'users' => $users,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
