<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function  addToCartQv(Request $request) {
        if ($request->ajax()) {
            $product = Product::find($request->id);
            Cart::add([
                'id'     => $product->id,
                'name'   => $product->name,
                'qty'    => $request->qty,
                'price'  => $request->price,
                'weight' => '1',
                'options' => [
                    'size'      => $request->size,
                    'color'     => $request->color,
                    'thumbnail' => $product->thumbnail,
                ]
            ]);
            return response()->json("Cart added");
        }
    }



    public function myCart() {
        $cart_content = Cart::content();
        // return response()->json($cart_content);
        $category = Category::all();
        return view('website.cart.cart',compact('category','cart_content'));

    }


    public function cartReload(Request $request) {
        if ($request->ajax()) {
            $cartLoad = Cart::total();
            $cartCount = Cart::count();
            return response()->json([
                'cartLoad'=>$cartLoad,
                'cartCount'=>$cartCount,
            ]);
        }
    }


    public function cartEmpty() {
        $cardEmpty = Cart::destroy();
        return back();
    }

    public function cartRemove(Request $request) {
            Cart::remove($request->button_id);
            return response()->json("Cart removed !");

    }

    // cardCount();



}
