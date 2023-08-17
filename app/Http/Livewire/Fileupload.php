<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Fileupload extends Component
{

    use WithFileUploads;

    public $file;
    public $title;
    public $description;
    public $price;
    public $duration;

    protected $rules = [
        'file' => 'required',
        'title' => 'required|min:3',
        'description' => 'string|nullable',
        'price' => 'required|numeric',
        'duration' => 'required|numeric',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
 

    public function save()
    {
        $validatedData = $this->validate();
        dd($validatedData);
    }

    public function render()
    {
        return view('livewire.fileupload');
    }
}
