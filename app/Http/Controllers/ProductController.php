<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ProductController extends Controller
{
    public function all(){
        $products = Product::all();
        return view("product.list",[
            "products"=>$products
        ]);
    }

    public function form(){
        $categories = Category::all();
        return view("product.form",[
            "categories"=>$categories
        ]);
    }

    public function save(Request $request){
        $request->validate([
            "name"=>"required",
            "price"=>"required|numeric|min:0",
            "qty"=>"required|numeric|min:0",
            "category_id"=>"required|numeric|min:1",
        ],[
            "name.required"=>"Vui lòng nhập tên sản phẩm",
            "price.min"=>"Giá phải ít nhất là 0",
            "price.required"=>"Vui lòng nhập giá sản phẩm"
        ]);

        try {
            Product::create([
                "name"=>$request->get("name"),
                "image"=>$request->get("image"),
                "description"=>$request->get("description"),
                "price"=>$request->get("price"),
                "qty"=>$request->get("qty"),
                "category_id"=>$request->get("category_id"),
            ]);
            return redirect()->to("products");
        }catch (\Exception $e){
            abort(404);
        }
    }

    public function edit($id){
        $categories = Category::all();
        $product= Product::findOrFail($id);// neu ko tim dc se sang 404
        return view("product.edit",[
            "product"=>$product,
            "categories"=>$categories
        ]);
    }

    public function update(Request  $request,$id){
        $product= Product::findOrFail($id);// neu ko tim dc se sang 404
        $request->validate([
            "name"=>"required",
            "price"=>"required|numeric|min:0",
            "qty"=>"required|numeric|min:0",
            "category_id"=>"required|numeric|min:1",
        ],[
            "name.required"=>"Vui lòng nhập tên sản phẩm",
            "price.min"=>"Giá phải ít nhất là 0",
            "price.required"=>"Vui lòng nhập giá sản phẩm"
        ]);
        try {
            $product->update([
                "name"=>$request->get("name"),
                "image"=>$request->get("image"),
                "description"=>$request->get("description"),
                "price"=>$request->get("price"),
                "qty"=>$request->get("qty"),
                "category_id"=>$request->get("category_id"),
            ]);
            return redirect()->to("products");
        }catch (\Exception $e){
            abort(404);
        }
    }

    public function delete($id){
        $product= Product::findOrFail($id);// neu ko tim dc se sang 404
        try {
            $product->delete();
            return redirect()->to("products");
        }catch (Exception $e){
            abort(404);
        }
    }
}
