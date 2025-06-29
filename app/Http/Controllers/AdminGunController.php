<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\GunDetail;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminGunController extends Controller
{
    //銃登録画面表示
    public function Show()
    {
        //roleが0のItem（銃）を取得
        $categories = Category::where('role', 0)
            ->with('children')// 子カテゴリーを取得
            ->get();
        return view('dash.gun-register',compact('categories'));
    }

    //銃登録
    public function Add(Request $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->is_stock = $request->is_stock;
        $item->category_id  = $request->category_id;
        $item->note = $request->note;
        $item->save();

        $gunDetail = new GunDetail();
        $gunDetail->item_id = $item->id;
        //画像をstorageに保存
        if($request->file('image') != null){
            $file_name = $request->file('image')->getClientOriginalName(); // 元のファイル名を取得
            $path = $request->file('image')->storeAs('img/'.$item->id, $file_name, 'public'); // 画像を保存
            $gunDetail->image = $request->file('image')->getClientOriginalName();
        }else{
            $gunDetail->image = null;
        }
        $gunDetail->model = $request->model;
        $gunDetail->country = $request->country;
        $gunDetail->brand = $request->brand;
        $gunDetail->full_length = $request->full_length;
        $gunDetail->full_weight = $request->full_weight;
        $gunDetail->diameter = $request->diameter;
        $gunDetail->save();

        return redirect()->route('admin.gun.show');
    }

    //銃編集画面表示
    public function ShowEdit()
    {
        //roleが0のItem（銃）を取得
        $categories = Category::where('role', 0)
            ->orderBy('name')
            ->with('children')// 子カテゴリーを取得
            ->get();

        $items = Item::orderBy('category_id')->orderBy("id")->get();
        return view('dash.gun-edit',compact('categories','items'));
    }

    //銃編集
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
        $item->category_id  = $request->category_id;
        $item->note = $request->note;
        $item->save();

        $gunDetail = GunDetail::where('item_id',$request->id)->first();
        //画像をstorageに保存
        if($request->file('image') != null){
            $directory = 'img/' . $item->id; // 画像を保存するディレクトリ
            // 既存のディレクトリを削除
            if (Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->deleteDirectory($directory);
            }

            $file_name = $request->file('image')->getClientOriginalName(); // 元のファイル名を取得
            $path = $request->file('image')->storeAs('img/'.$item->id, $file_name, 'public'); // 画像を保存
            $gunDetail->image = $request->file('image')->getClientOriginalName();
        }
        $gunDetail->model = $request->model;
        $gunDetail->country = $request->country;
        $gunDetail->brand = $request->brand;
        $gunDetail->full_length = $request->full_length;
        $gunDetail->full_weight = $request->full_weight;
        $gunDetail->diameter = $request->diameter;
        $gunDetail->save();

        return redirect()->route('admin.gun.edit');
    }

    //銃削除
    public function Delete($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('admin.gun.edit');
    }
}
