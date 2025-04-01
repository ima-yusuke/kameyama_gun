<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class AdminBulletController extends Controller
{
    public function Show()
    {
        //roleが1のItem（弾）を取得し、それらのカテゴリーを取得（重複を削除）し、"未設定"を除外
        $categories = Item::where('role', 1)
            ->with('category')
            ->get()
            ->unique('category_id') // category_id の重複を削除
            ->pluck('category') // category のみ取得
            ->filter(fn($category) => $category->name !== '未設定');// "未設定" を除外

        return view('dash.bullet-register', compact('categories'));
    }
}
