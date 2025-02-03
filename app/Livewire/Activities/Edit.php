<?php

namespace App\Livewire\Activities;

use App\Models\Activities;
use Livewire\Component;

class Edit extends Component
{
    public $aktivitasId;
    public $name;
    public $description;

     public function mount($aktivitasId)
    {
        $aktivitas = Activities::find($aktivitasId);

        if ($aktivitas) {
            $this->aktivitasId = $aktivitas->id;
            $this->name = $aktivitas->name;
            $this->description = $aktivitas->description;
        }
    }

     public function update()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($this->aktivitasId) {
            $aktivitas = Activities::find($this->aktivitasId);

            if ($aktivitas) {
                $aktivitas->update([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);
            };
        }

        session()->flash('message', 'Data berhasil diubah.');
        return redirect()->route('activities.index');
    }

    public function render()
    {
        return view('livewire.activities.edit');
    }
}
