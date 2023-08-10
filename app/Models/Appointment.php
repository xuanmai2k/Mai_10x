<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'appointment';

    public $fillable = [
        'users_id',
        'name',
        'email',
        'phone',
        'age',
        'doctor_id',
        'nurse_id',
        'product_category_id',
        'product_id',
        'date_appointment',
        'time_appointment',
        'total_price',
        'status',
        'pay_by',
        'rating',
        'comment',
        'status_payment',
        'order_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id')->withTrashed();
    }

    public function category(){
        return $this->belongsTo(ProductCategory::class,'product_category_id')->withTrashed();
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id')->withTrashed();
    }

    public function nurse(){
        return $this->belongsTo(Nurse::class,'nurse_id')->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

}
