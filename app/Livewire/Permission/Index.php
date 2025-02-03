<?php

namespace App\Livewire\Permission;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public $search;

    use WithPagination;
        /**
     * destroy function
     */
    public function destroy($permissionId)
    {
        //get permission
        $permission = Permission::find($permissionId);

        if ($permission) {
            $permission->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('permission.index');
    }

    public function render()
    {
        return view('livewire.permission.index', [
            'permissions' => Permission::where('name','like','%'.$this->search.'%')->paginate(5),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
