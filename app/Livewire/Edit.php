<?php

namespace App\Livewire;

use Livewire\Component;

class Edit extends Component
{
    public $showModal = false;
    public function render()
    {
        return view('livewire.edit');
    }
}
