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
        $users = User::query()
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%') // Cari berdasarkan ID
                      ->orWhere('name', 'like', '%' . $this->search . '%')
                      ->orWhere('nrp','like','%'. $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhereHas('roles', function ($roleQuery) {
                          $roleQuery->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->paginate(5);

        return view('livewire.pages.user.index', [
            'users' => $users,
        ]);
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }
}
