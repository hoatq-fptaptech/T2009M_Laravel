<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $cart = Session::get("cart");
        return view("cart.cart",["cart"=>$cart]);
    }
}
