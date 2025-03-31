<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GunDetail extends Model
{
    protected $fillable = [
        'ite,_id',
        'image',
        'model',
        'country',
        'brand',
        'full_length',
        'full_weight',
        'diameter',
    ];
}
