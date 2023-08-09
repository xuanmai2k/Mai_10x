<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MomoPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'momo_payment';

    public $fillable = [
        'partner_code',
        'order_id',
        'request_id',
        'amount',
        'order_info',
        'order_type',
        'trans_id',
        'pay_type',
        'response_time',
        'message',
        'users_id',
    ];
}
