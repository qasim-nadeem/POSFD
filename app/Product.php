<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    //
    protected $fillable = [
            'name',
            'quantity',
            'price_per_unit',
            'code',
            'manufacture_name',
            'model_name',
            'color',
            'total_quantity',
            'purchase_price'
    ];
}
