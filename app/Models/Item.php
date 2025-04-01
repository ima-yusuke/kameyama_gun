<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=[
        'role',
        'name',
        'price',
        'is_stock',
        'category_id',
        'note',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault([
            'name' => '未設定'
        ]);
    }

    public function gunDetail()
    {
        return $this->hasOne('App\Models\GunDetail');
    }
}
