<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    //カテゴリー登録画面表示
    public function Show()
    {
        $categories = Category::all();
        return view('dash.category-register',compact('categories'));
    }

    //カテゴリー登録
    public function Add(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        if($request->parent_id == 0) {
            $category->parent_id = null;
        }else{
            $category->parent_id = $request->parent_id;
        }
        $category->save();
        return redirect()->route('admin.category.show');
    }

    //カテゴリー編集画面表示
    public function ShowEdit()
    {
        $categories = Category::all();
        return view('dash.category-edit',compact('categories'));
    }

    //カテゴリー編集
    public function Update(Request $request)
    {
        $category = Category::find($request->id);

        //カテゴリー名
        $category->name = $request->name;

        if($request->parent_id == 0) {
            //ルートカテゴリー
            $category->parent_id = null;
        }else{
            $category->parent_id = $request->parent_id;
        }
        $category->save();
        return redirect()->route('admin.category.edit');
    }

    //カテゴリー削除
    public function Delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.category.edit');
    }
}
