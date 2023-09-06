<?php

namespace App\Http\Livewire;

use App\Models\Licence;
use DateTime;
use Livewire\Component;

class Content extends Component
{
    public $licence_key;
    public $file_type;
    public $file_path;
    public $is_allowed = false;
    protected $rules = [
        'licence_key' => 'required',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function show()
    {
        $this->validate();
        $licence_key = Licence::where('key', $this->licence_key)->first();

        if ($licence_key) {
            if ($this->is_expired($licence_key)) $this->addError('licence_key', 'Licence key expired');
            else {
                $this->file_type = $licence_key->content->type;
                $this->file_path = $licence_key->content->filepath;
                $this->is_allowed = true;
            }
        } else $this->addError('licence_key', 'Invalid licence key');
    }

    public function render()
    {
        return view('livewire.content');
    }

    public function is_expired($key)
    {
        if ($key->is_expired) {
            return true;
        }

        $current_date = now();
        $old_date = $key->created_at;
        $duration = $key->content->duration;

        if ($current_date->diffInDays($old_date) >= $duration) {
            $key->update(['is_expired' => true]);
            return true;
        }

        return false;
    }
}
