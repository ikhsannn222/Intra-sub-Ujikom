<?php

namespace App\Livewire\AttachUser;

use App\Models\AttachUser;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;

    public function destroy($attachUserId)
    {
        $attachUser = AttachUser::find($attachUserId);

        if ($attachUser) {
            $attachUser->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('attach-user.index');
    }

    public function render()
    {
        return view('livewire.attach-user.index', [
            'attachUser' => AttachUser::with(['users', 'projects'])->latest()->paginate(5)
        ]);
    }
}
