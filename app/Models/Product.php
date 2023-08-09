<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'product';

    public $fillable = [
        'name_product',
        'slug',
        'product_category_id',
        'price',
        'short_description',
        'description',
        'information',
        'made_in',
        'dosage',
        'qty',
        'image_url',
        'status',
    ];

    public function category(){
        return $this->belongsTo(ProductCategory::class,'product_category_id')->withTrashed();
    }

    public function product(){
        return $this->hasMany(Appointment::class,'product_id')->withTrashed();
    }

}
