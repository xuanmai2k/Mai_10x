<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_category';

    public $fillable = [
        'name',
        'slug',
        'minimum_limit_age',
        'maximum_limit_age',
        'quantity_for_injection',
        'status',
    ];

    public function products(){
        return $this->hasMany(Product::class,'product_category_id')->withTrashed();
    }

    public function appointment(){
        return $this->hasMany(Appointment::class,'product_category_id')->withTrashed();
    }

}
