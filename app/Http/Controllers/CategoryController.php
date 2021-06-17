<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function all(){
        $categories = DB::table("categories")->get(); // tra ve 1 list object
        return view("category.list",[
            "categories"=>$categories
        ]);
    }

    public function form(){
        return view("category.form");
    }

    public function save(Request $request){
        $name = $request->get("name");
        $now = Carbon::now();// datetime
        DB::table("categories")->insert([
            "name"=>$name,
            "created_at"=>$now,
            "updated_at"=>$now,
        ]);
        return redirect()->to("/categories");// giong header("Location ...
    }

}
