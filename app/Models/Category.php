<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable=[
        'name',
        'parent_id'
    ];

    //現在のカテゴリの子カテゴリを再帰的に取得
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }
}
