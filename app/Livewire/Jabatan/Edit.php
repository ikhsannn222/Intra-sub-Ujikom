<?php

namespace App\Livewire\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;

class Edit extends Component
{
    public $jabatan;
    public $name;

    public function mount($id)
    {
        // Temukan jabatan berdasarkan id yang diterima
        $this->jabatan = Jabatan::findOrFail($id);
        $this->name = $this->jabatan->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required'
        ]);

        // Update jabaatan dengan nama yang baru
        $this->jabatan->update([
            'name' => $this->name
        ]);

        session()->flash('message', 'Data berhasil diperbarui.');

        return redirect()->route('jabatan.index');
    }

    public function render()
    {
        return view('livewire.jabatan.edit');
    }
}
