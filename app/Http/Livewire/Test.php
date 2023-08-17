<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $title;


    public function save(){
        dd($this->title);
    }

    public function mount()
    {
        $comp = "123";
        $this->title = $comp;
    }
    public function render()
    {
        return view('livewire.test');
    }
}
