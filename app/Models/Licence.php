<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'key',
        'email'
    ];

    public function content(){
        return $this->belongsTo(Content::class);
    }
}
