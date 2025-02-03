<?php

namespace App\Livewire\Bagian;

use App\Models\Bagian;
use Livewire\Component;

class Edit extends Component
{
    public $bagian;
    public $name;

    public function mount($id)
    {
        // Temukan bagian berdasarkan id yang diterima
        $this->bagian = Bagian::findOrFail($id);
        $this->name = $this->bagian->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required'
        ]);

        // Update bagian dengan nama yang baru
        $this->bagian->update([
            'name' => $this->name
        ]);

        session()->flash('message', 'Data berhasil diperbarui.');

        return redirect()->route('bagian.index');
    }

    public function render()
    {
        return view('livewire.bagian.edit');
    }
}
