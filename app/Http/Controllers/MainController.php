<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public $dataArray = [
        ["id"=>1, "name"=>"ABC銃", "price"=>2500, "role"=>0, "is_stock"=>true, "note"=>"Good guns"],
        ["id"=>2, "name"=>"XYZ銃", "price"=>3200, "role"=>0, "is_stock"=>false, "note"=>"High quality"],
        ["id"=>3, "name"=>"DEF弾", "price"=>800, "role"=>1, "is_stock"=>true, "note"=>"Reliable"],
        ["id"=>4, "name"=>"LMN装備", "price"=>5000, "role"=>2, "is_stock"=>true, "note"=>"Limited edition"],
        ["id"=>5, "name"=>"PQRライフル", "price"=>7200, "role"=>0, "is_stock"=>false, "note"=>"Military grade"],
        ["id"=>6, "name"=>"STUハンドガン", "price"=>2900, "role"=>0, "is_stock"=>true, "note"=>"Budget-friendly"],
        ["id"=>7, "name"=>"VWXショットガン", "price"=>4500, "role"=>0, "is_stock"=>false, "note"=>"Best seller"],
        ["id"=>8, "name"=>"YZAスナイパー", "price"=>8900, "role"=>0, "is_stock"=>true, "note"=>"Precision aim"],
        ["id"=>9, "name"=>"GHI弾", "price"=>950, "role"=>1, "is_stock"=>true, "note"=>"Top performance"],
        ["id"=>10, "name"=>"JKL装備", "price"=>4700, "role"=>2, "is_stock"=>false, "note"=>"Tactical gear"],
        ["id"=>11, "name"=>"MNO銃", "price"=>3600, "role"=>0, "is_stock"=>true, "note"=>"Good durability"],
        ["id"=>12, "name"=>"QRS弾", "price"=>1100, "role"=>1, "is_stock"=>true, "note"=>"Long range"],
        ["id"=>13, "name"=>"TUV装備", "price"=>5300, "role"=>2, "is_stock"=>false, "note"=>"Premium quality"],
        ["id"=>14, "name"=>"WXYライフル", "price"=>7600, "role"=>0, "is_stock"=>true, "note"=>"High precision"],
        ["id"=>15, "name"=>"ZABハンドガン", "price"=>3100, "role"=>0, "is_stock"=>false, "note"=>"Compact design"],
        ["id"=>16, "name"=>"CDEショットガン", "price"=>4800, "role"=>0, "is_stock"=>true, "note"=>"High power"],
        ["id"=>17, "name"=>"FGHスナイパー", "price"=>9100, "role"=>0, "is_stock"=>false, "note"=>"Extreme accuracy"],
        ["id"=>18, "name"=>"IJK弾", "price"=>980, "role"=>1, "is_stock"=>true, "note"=>"Fast reload"],
        ["id"=>19, "name"=>"LMN装備", "price"=>5900, "role"=>2, "is_stock"=>false, "note"=>"Heavy duty"],
        ["id"=>20, "name"=>"OPQ銃", "price"=>3400, "role"=>0, "is_stock"=>true, "note"=>"Reliable performance"],
        ["id"=>21, "name"=>"RST弾", "price"=>1200, "role"=>1, "is_stock"=>false, "note"=>"Penetration power"],
        ["id"=>22, "name"=>"UVW装備", "price"=>6000, "role"=>2, "is_stock"=>true, "note"=>"Best in class"],
        ["id"=>23, "name"=>"XYZライフル", "price"=>7800, "role"=>0, "is_stock"=>false, "note"=>"Military standard"],
        ["id"=>24, "name"=>"ABCハンドガン", "price"=>3300, "role"=>0, "is_stock"=>true, "note"=>"Lightweight"],
        ["id"=>25, "name"=>"DEFショットガン", "price"=>5000, "role"=>0, "is_stock"=>false, "note"=>"Close combat"],
        ["id"=>26, "name"=>"GHIスナイパー", "price"=>9200, "role"=>0, "is_stock"=>true, "note"=>"Ultra precision"],
        ["id"=>27, "name"=>"JKL弾", "price"=>1050, "role"=>1, "is_stock"=>true, "note"=>"Explosive rounds"],
        ["id"=>28, "name"=>"MNO装備", "price"=>6200, "role"=>2, "is_stock"=>false, "note"=>"Tactical advantage"],
        ["id"=>29, "name"=>"PQR銃", "price"=>3700, "role"=>0, "is_stock"=>true, "note"=>"Strong build"],
        ["id"=>30, "name"=>"STU弾", "price"=>1250, "role"=>1, "is_stock"=>false, "note"=>"Armor piercing"]
    ];


    public function show()
    {
        $dataArray = $this->dataArray;
        return view('main',compact('dataArray'));
    }
}
