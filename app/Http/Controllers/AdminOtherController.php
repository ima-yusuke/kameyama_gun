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
    public function ShowEdit()
    {
        //roleが2のItem（その他）を取得
        $categories = Category::where('role', 2)
            ->with('children')// 子カテゴリーを取得
            ->get();

        $items = Item::orderBy('category_id')->orderBy("id")->get();
        return view('dash.other-edit',compact('categories','items'));
    }

    //その他編集
    public function Update(Request $request)
    {
        $item = Item::find($request->id);
        $item->name = $request->name;
        if($request->price == null) {
            $item->price = 0; // 価格が入力されていない場合は0に設定
        } else {
            // カンマを削除して数値として保存
            $item->price = str_replace(',', '', $request->price);
        }
        $item->is_stock = $request->is_stock;
        $item->category_id = $request->category_id;
        $item->note = $request->note;
        $item->save();

        return redirect()->route('admin.other.edit');
    }

    //その他削除
    public function Delete($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->route('admin.other.edit');
    }
}
