<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        Cart::destroy();
        $alert = array('message'=>'Cart item clear', 'alert-type'=>'success');
        return redirect('/')->with($alert);
    }

    public function cartRemove(Request $request) {
        Cart::remove($request->button_id);
        return response()->json("Cart removed !");

    }


    public function cartUpdateQty(Request $request){
        $cartId = $request->cartId;
        $qty = $request->qty;

        Cart::update($cartId, ['qty' => $qty ]);
        return response()->json("Cart quantity Update");
    }

    public function cartUpdateColor(Request $request){
        $cartId = $request->cartId;
        $color = $request->color;
        $cart_color = Cart::get($cartId);
        $thumbnail = $cart_color->options->thumbnail;
        $size = $cart_color->options->size;
        Cart::update($cartId, ['options'=> ['color' => $color, 'thumbnail'=>$thumbnail, 'size'=>$size]]);
        return response()->json("Cart color Update");
    }


    public function cartUpdateSize(Request $request){
        $cartId = $request->cartId;
        $size = $request->size;

        $cart_size = Cart::get($cartId);
        $thumbnail = $cart_size->options->thumbnail;
        $color = $cart_size->options->color;
        Cart::update($cartId, ['options'=> ['size'=>$size,'thumbnail'=>$thumbnail,'color' => $color]]);
        return response()->json("Cart Size Update");
    }



    // wishlist method

    public function wishlist() {
        if (Auth::check()) {
            $category = Category::all();
            $products = Wishlist::where('user_id',auth::id())->get();
            return view('website.wishlist',compact('category','products'));
        }
        $alert = array('message'=>'at first login your account', 'alert-type'=>'success');
        return redirect('/')->with($alert);
    }

    public function addWishlist($product_id) {
        if (Auth::check()) {
            $check = Wishlist::where('product_id',$product_id)->where('user_id',auth::id())->first();

        if ($check) {
            $message = array('message'=>'Already have it on your wishlist !','alert-type'=>'error' );
            return redirect()->back()->with($message);
        } else {
            $addWishlist=Wishlist::create([
                'user_id'    => Auth::id(),
                'product_id' => $product_id,
            ]);
            $message = array('message'=>'Product Added on Wishlist !','alert-type'=>'success');
            return redirect()->back()->with($message);
        }

        } else {
            $message = array('message'=>'At first login to your account !','alert-type'=>'error');
            return redirect()->back()->with($message);
        }



    }



    public function emptyWishlist() {
        Wishlist::where('user_id',auth::id())->delete();
        $message = array('message'=>'Wishlist clear !','alert-type'=>'success');
        return redirect()->back()->with($message);

    }
    public function WishlistProductRemove($id) {
        Wishlist::where('id',$id)->delete();
        $message = array('message'=>'Product remove successfully!','alert-type'=>'success');
        return redirect()->back()->with($message);

    }




}
