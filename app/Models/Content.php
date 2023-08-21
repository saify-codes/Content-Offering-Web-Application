<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    public $table = 'content';
    public $timestamps = false;
    
    protected $fillable = [
        'title',
        'description',
        'type',
        'filepath',
        'price',
        'duration',
        'has_subscription',
        'user_id'
    ];

}
