<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
protected $table = 'suppliers';

    protected $fillable = [
            'name',
            'mobile_no',
            'address',
            'company_name',
            'balance',
    ];
    
}
