<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
// use Livewire\Attributes\Reactive;
use Livewire\Component;

class Children extends Component
{
    // #[Reactive]  esta es una opción -1
    #[Modelable] //otra opción -2
    public $name;

    public function changeName () {
        $this->dispatch('name-status', 'Jerry');
    }

    public function render()
    {
        return view('livewire.children');
    }
}
