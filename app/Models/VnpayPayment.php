<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VnpayPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vnpay_payment';

    public $fillable = [
        'vnp_amount',
        'vnp_bankcode',
        'vnp_banktranno',
        'vnp_cardtype',
        'vnp_orderinfo',
        'vnp_paydate',
        'vnp_tmncode',
        'vnp_transactionno',
        'vnp_transactionstatus',
        'users_id',
    ];
}
