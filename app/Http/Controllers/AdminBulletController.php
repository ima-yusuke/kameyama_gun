<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;

class AdminBulletController extends Controller
{
    public function Show()
    {
        //roleが1のItem（弾）を取得
        $categories = Category::where('role', 1)
            ->with('children')// 子カテゴリーを取得
            ->get();

        return view('dash.bullet-register', compact('categories'));
    }

    public function Add(Request $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->is_stock = $request->is_stock;
        $item->category_id = $request->category_id;
        $item->note = $request->note;
        $item->save();

        return redirect()->route('admin.bullet.show');
    }

    //弾編集view表示
    public function ShowEdit()
    {
        //roleが1のItem（弾）を取得
        $categories = Category::where('role', 1)
            ->with('children')// 子カテゴリーを取得
            ->get();

        $items = Item::orderBy('category_id')->orderBy("id")->get();

        return view('dash.bullet-edit',compact('categories','items'));
    }

    //弾編集
    public function Update(Request $request)
    {
        $item = Item::find($request->id);
        $item->name = $request->name;
        if($request->price == null) {
            $item->price = 0; // 価格が入力されていない場合は0に設定
        } else {
            // カンマを削除して数値として保存
            $item->price = str_replace(',', '', $request->price);
        }        $item->is_stock = $request->is_stock;
        $item->category_id = $request->category_id;
        $item->note = $request->note;
        $item->save();
        return redirect()->route('admin.bullet.edit');
    }

    //弾削除
    public function Delete($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->route('admin.bullet.edit');
    }
}
