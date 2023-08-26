<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable =[

        'itemCode',
        'name',
        'description',
        'categoryId',
        'subcategoryId',
        'costPrice',
        'sellingPrice',
        'warranty',
        'vatTax',
        'unit',
        'quantity',
        'size',
        'color',
        'image',
        'brandName',
        'expiryDate',
        'vendorId',
        'userId',
        'status',

    ];

}
