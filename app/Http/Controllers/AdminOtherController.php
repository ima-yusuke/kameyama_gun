<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class AdminOtherController extends Controller
{
    //その他登録view表示
    public function Show()
    {
        //roleが2のItem（その他）を取得
        $categories = Category::where('role', 2)
            ->with('children')// 子カテゴリーを取得
            ->get();

        return view('dash.other-register', compact('categories'));
    }

    //その他登録
    public function Add(Request $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->is_stock = $request->is_stock;
        $item->category_id = $request->category_id;
        $item->note = $request->note;
        $item->save();

        return redirect()->route('admin.other.show');
    }

    //その他編集view表示
}
