<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{


    protected $fillable = [
        'total',
        'discount',
        'payable',
        'vat',
        'user_id',
        'customer_id',
    ];

    function customer(){
        return $this->belongsTo(Customer::class);
    }


    use HasFactory;
}
