<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';

    public $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'image_url',
        'status',
    ];
}
