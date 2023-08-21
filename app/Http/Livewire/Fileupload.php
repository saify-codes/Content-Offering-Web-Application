<?php

namespace App\Http\Livewire;

use App\Models\Content;
use Illuminate\Support\Facades\Auth;
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
    public $subscription=false;

    protected $rules = [
        'file' => 'required',
        'title' => 'required|min:3',
        'description' => 'string|nullable',
        'price' => 'required|numeric|min:1|max:1000',
        'duration' => 'required|numeric|min:1',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function subscription(){
        $this->subscription = !$this->subscription;
        // dd("here");
    }

    public function save()
    {
        $this->validate();
        $file_path = $this->file->store('contents', 'public');
        $file_type = $this->get_file_type();

        Content::create(
            [
                'title' => $this->title,
                'price' => $this->price,
                'duration' => $this->duration,
                'has_subscription' => $this->subscription,
                'description' => $this->description,
                'filepath' => $file_path,
                'type' => $file_type,
                'user_id' => Auth::user()->id
            ]
        ); 

        $this->clear();

        session()->flash('status','content uploaded successfully');
        
    }


    public function render()
    {
        return view('livewire.fileupload');
    }

    private function clear()
    {
        $this->file = null;
        $this->title = '';
        $this->price = '';
        $this->duration = '';
        $this->description = '';
        $this->subscription = false;
    }

    private function get_file_type(){
        $type = explode('/',$this->file->getMimeType())[0];
        return match($type){
            'video' => 1,
            'image' => 2,
            'application' => 3,
        };
    }
}
