<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ProductController extends Controller
{
    public function all(Request  $request)
    {
        // raw sql
//        $sql = "select * from products";
//        $products = DB::raw($sql);

        // use model
//        $products = Product::all(); // liet ke tat ca
        // join table
//        $products = Product::leftJoin("categories","categories.id","=","products.category_id")
//            ->select("products.*","categories.name as category_name")->get();

        // su dung relationship
//        $products = Product::with("Category")->get();
        // pagination
        $categoryId = $request->get("category_id");
        $search = $request->get("search");
        // chi dành cho trẻ sơ cấp - số lượng chỉ 1 2 cái cần lọc
//        if ($categoryId && $search) {
//            $products = Product::with("Category")->where("category_id", $categoryId)->paginate(10);
//        }else if($search) {
//
//        }else if($categoryId){
//
//        }else{
//            $products = Product::with("Category")->paginate(20);
//        }

        // su dung scope seach
        $products = Product::with("Category")->search($search)->category($categoryId)->orderBy("id","desc")->paginate(20);
      //  dd($products);// print data de kiem tra

        $categories = Category::all();
        return view("product.list",[
            "products"=>$products,
            "categories"=>$categories
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
            $image = "";
            // lam the nao đó để up file lên thư mục upload trong public và lấy link ảnh đưa vào biến $image
            if($request->hasFile("image")){
                $file = $request->file("image");// tạo 1 đối tượng file
                $fileName = time().$file->getClientOriginalName(); // lấy tên file gốc (tên khi up lên)  vis du: ngoctrinh.png
                $ext = $file->getClientOriginalExtension();// lấy loại file ( ví dụ png jpg..)
                $fileSize = $file->getSize();// dùng để giới hạn kích thước têp up lên nếu cần (tính bằng Byte)
                if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif"){ // chỉ cho upload những file dạng này
                    if($fileSize < 10000000){ // ko qua 10MB
                        $file->move("upload",$fileName);
                        $image = "upload/".$fileName;
                    }
                }
            }
            Product::create([
                "name"=>$request->get("name"),
                "image"=>$image,
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
