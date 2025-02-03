<?php

namespace App\Livewire\ProjectStatuses;

use App\Models\Statuses;
use Livewire\Component;

class Edit extends Component
{
    public $statusId;
    public $name;
    public $color;
    public $is_default;

    public function mount($statusId)
    {
        $status = Statuses::find($statusId);

        if ($status) {
            $this->statusId = $status->id;
            $this->name = $status->name;
            $this->color = $status->color;
            $this->is_default = (bool) $status->is_default;
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'color' => 'required',
        ]);

        if ($this->statusId) {
            $status = Statuses::find($this->statusId);

            if ($status) {
                $status->update([
                    'name' => $this->name,
                    'color' => $this->color,
                    'is_default' => $this->is_default,
                ]);
            };
        }

        session()->flash('message', 'Data berhasil diubah.');
        return redirect()->route('project-statuses.index');
    }

    public function render()
    {
        return view('livewire.project-statuses.edit');
    }
}
