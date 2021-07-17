<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;

class WebController extends Controller
{
    public function home(){
        return view("home");
    }

    public function aboutUs(){
        return view("about-us");
    }


    // them sp vao gio hang
    public function addToCart($id){
        // tim sp
        $product = Product::findOrFail($id);
        // cho sp vao gio hang - session
        $cart = [];// mac dinh ban dau la chua co sp nao
        if(Session::has("cart")){
            $cart = Session::get("cart");
        }
        // kiem tra xem gio hang da co sp nay hay chua
        if(!$this->checkCart($cart,$product)){// neu sp chua co trong gio hang
            $product->cart_qty = 1;// them 1 thuoc tinh cart_qty
            $cart[] = $product; // nap vao gio hang
        }else{
            for ($i=0;$i<count($cart);$i++){
                if($cart[$i]->id==$product->id){
                    $cart[$i]->cart_qty = $cart[$i]->cart_qty+1;
                    break;
                }
            }
        }
        // gan tro lai cart vao session
        Session::put("cart",$cart);
        return redirect()->back();
    }

    // tim kiem xem sp co trong array ko
    private function checkCart(array $cart,Product $p){
        foreach ($cart as $item){
            if($item->id == $p->id)
                return true;
        }
        return false;
    }

    public function cart(){
        $cart = [];
        if(Session::has("cart"))
            $cart = Session::get("cart");
        return view("cart.cart",["cart"=>$cart]);
    }

    public function checkout(){
        if(!Session::has("cart")){
            return redirect()->to("/cart");// chuyen huong ve trang gio hang khi ko co san pham
        }
        $cart = Session::get("cart");
        $grandTotal = 0;
        foreach ($cart as $item){
            $grandTotal += $item->cart_qty * $item->price;
        }
        return  view("cart.checkout",["cart"=>$cart,"grandTotal"=>$grandTotal]);
    }

    public function createOrder(Request $request){
        if(!Session::has("cart")){
            return redirect()->to("/cart");// chuyen huong ve trang gio hang khi ko co san pham
        }
        $cart = Session::get("cart");
        $request->validate([
           "customer_name"=>"required",
           "customer_tel"=>"required",
           "customer_address"=>"required",
        ]);
        try {
            // tao don hang
            $grandTotal = 0;
            foreach ($cart as $item){
                $grandTotal += $item->cart_qty * $item->price;
            }
            $order = Order::create([
                "customer_name"=>$request->get("customer_name"),
                "customer_tel"=>$request->get("customer_tel"),
                "customer_address"=>$request->get("customer_address"),
                "city"=>$request->get("city"),
                "shipping_fee"=>0,
                "grand_total"=>$grandTotal,
            ]);
            foreach ($cart as $item){
                DB::table("orders_items")->insert([
                   "order_id"=>$order->id,
                   "product_id"=>$item->id,
                   "qty"=>$item->cart_qty,
                   "price"=>$item->price,
                ]);
                // con 1 viec nua - giam so luong san pham
                Product::where("id",$item->id)->decrement("qty",$item->cart_qty);
            }
            // con phai lam 1 viec nua - xoa gio hang
            Session::forget("cart");// Session::put("cart",null);


        }catch (Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("orderSuccess");
    }
}
