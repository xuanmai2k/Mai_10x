<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nurse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nurse';

    public $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'dob',
        'position',
        'short_information',
        'information',
        'image_url',
    ];

    public function appointment(){
        return $this->hasMany(Appointment::class,'nurse_id')->withTrashed();
    }
}
