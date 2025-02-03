<?php

namespace App\Livewire\Priorities;

use App\Models\Priorities;
use Livewire\Component;

class Edit extends Component
{
    public $prioritasId;
    public $name;
    public $color;
    public $is_default;

    public function mount($prioritasId)
    {
        $prioritas = Priorities::find($prioritasId);

        if ($prioritas) {
            $this->prioritasId = $prioritas->id;
            $this->name = $prioritas->name;
            $this->color = $prioritas->color;
            $this->is_default = (bool) $prioritas->is_default;
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'color' => 'required',
        ]);

        if ($this->prioritasId) {
            $prioritas = priorities::find($this->prioritasId);

            if ($prioritas) {
                $prioritas->update([
                    'name' => $this->name,
                    'color' => $this->color,
                    'is_default' => $this->is_default,
                ]);
            };
        }

        session()->flash('message', 'Data berhasil diubah.');
        return redirect()->route('priorities.index');
    }

    public function render()
    {
        return view('livewire.priorities.edit');
    }
}
