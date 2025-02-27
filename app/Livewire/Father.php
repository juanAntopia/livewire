<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Father extends Component
{
    public $name = 'Juan';

    #[On('name-status')]
    public function updateName () {
        $this->name = 'jerry';
    }

    public function render()
    {
        return view('livewire.father');
    }
}
