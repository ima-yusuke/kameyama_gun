<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function show()
    {
        // 最初に Category をロード（items には category と gunDetail を含める）
        $categories = Category::with([
            'children', // 再帰的な子カテゴリ
            'items.category', // items の category をロード
            'items.gunDetail', // items の gunDetail をロード
        ])->where('role', 0)->get();

        // 子カテゴリの items に category と gunDetail を含める
        $this->loadItemsRecursively($categories);

        // 全ての items を category & gunDetail 付きで取得
        $dataArray = Item::with(['category.children', 'gunDetail'])->orderBy("category_id")->orderBy("id")->get();

        return view('main', compact('dataArray', 'categories'));
    }

    private function loadItemsRecursively($categories)
    {
        foreach ($categories as $category) {
            // 子カテゴリの items に category と gunDetail を含める
            $category->loadMissing([
                'children.items.category',
                'children.items.gunDetail'
            ]);

            // もし子カテゴリがさらに子カテゴリを持っていれば、再帰的に処理を続ける
            if ($category->children->isNotEmpty()) {
                $this->loadItemsRecursively($category->children);
            }
        }
    }
}
