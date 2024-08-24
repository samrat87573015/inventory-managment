<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProducts extends Model
{


    protected $fillable = [
        'invoice_id',
        'product_id',
        'user_id',
        'quantity',
        'salePrice',
    ];


    function product()
    {
       return $this->belongsTo(Product::class);
    }



    use HasFactory;
}
