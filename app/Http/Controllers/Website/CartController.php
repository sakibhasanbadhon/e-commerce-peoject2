<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function  addToCartQv(Request $request) {
        if ($request->ajax()) {
            $product = Product::find($request->id);
            Cart::add([
                'id'=> $product->id,
                'name'=> $product->name,
                'qty'=> $request->qty,
                'price'=> $request->price,
                'weight'=> '1',
                'option'=> [
                    'size' =>$request->size,
                    'color' =>$request->color,
                    'thumbnail' =>$product->thumbnail,
                ]
            ]);
            return response()->json("cart added");
        }
    }



}
