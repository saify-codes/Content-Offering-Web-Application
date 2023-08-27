<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $file;
    public $title;
    public $description;
    public $price;
    public $duration;
    public $subscription = false;

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

    public function upload()
    {
        
        $this->validate();

        $file_path = $this->store();
        $file_type = $this->resolveFileType();

        Content::create([
            'title' => $this->title,
            'price' => $this->price,
            'duration' => $this->duration,
            'has_subscription' => $this->subscription,
            'description' => $this->description,
            'filepath' => $file_path,
            'type' => $file_type,
            'user_id' => Auth::user()->id
        ]);

        $this->clear();

        session()->flash('status', 'Content uploaded successfully');
    }

    public function render()
    {
        return view('livewire.upload');
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

    private function resolveFileType()
    {
        $type = explode('/', $this->file->getMimeType())[0];
        return match ($type) {
            'video' => 1,
            'image' => 2,
            'application' => 3,
            default => null,
        };
    }

    private function store(){
        $type = explode('/', $this->file->getMimeType())[0];
        return match($type){
            'video' => $this->file->store('contents/videos', 'public'),
            'image' => $this->file->store('contents/images', 'public'),
            'application' => $this->file->store('contents/documents', 'public'),
            default => null,
        };
    }
}
