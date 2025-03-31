<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function show()
    {
        //Item モデルの関連するcategoryを取得し、そのcategoryに関連する子カテゴリ（さらにその子カテゴリも）を再帰的に取得
        $dataArray = Item::with('category.children')->get();
        return view('main',compact('dataArray'));
    }
}
