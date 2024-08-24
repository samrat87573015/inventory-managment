<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'productName',
        'price',
        'quantity',
        'productImageUrl',
        'user_id',
        'category_id',
    ];


    use HasFactory;
}
