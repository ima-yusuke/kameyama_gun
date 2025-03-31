<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\GunDetail;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminGunController extends Controller
{
    public function Show()
    {
        $categories = Category::all();
        return view('dash.gun-register',compact('categories'));
    }

    public function Add(Request $request)
    {
        $item = new Item();
        $item->role = 0;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->is_stock = $request->is_stock;
        $item->category_id  = $request->category_id;
        $item->note = $request->note;
        $item->save();

        $gunDetail = new GunDetail();
        $gunDetail->item_id = $item->id;
        //画像をstorageに保存
        $file_name = $request->file('image')->getClientOriginalName(); // 元のファイル名を取得
        $path = $request->file('image')->storeAs('img/'.$item->id, $file_name, 'public'); // 画像を保存
        $gunDetail->image = $request->file('image')->getClientOriginalName();
        $gunDetail->model = $request->model;
        $gunDetail->country = $request->country;
        $gunDetail->brand = $request->brand;
        $gunDetail->full_length = $request->full_length;
        $gunDetail->full_weight = $request->full_weight;
        $gunDetail->diameter = $request->diameter;
        $gunDetail->save();

        return redirect()->route('admin.gun.show');
    }
}
