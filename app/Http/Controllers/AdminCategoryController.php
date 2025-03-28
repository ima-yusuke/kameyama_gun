<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function Show()
    {
        $categories = Category::all();
        return view('dash.category-register',compact('categories'));
    }

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
}
