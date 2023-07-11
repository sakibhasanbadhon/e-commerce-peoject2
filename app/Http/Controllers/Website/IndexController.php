<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    // root page
    public function index()
    {
        $category = Category::all();
        $slider_product = Product::where('slider_show',1)->latest()->first();
        return view('website.index', compact('category','slider_product'));
    }


    // single product page

    public function productDetails($slug_name){
        $category = Category::all();
        $product_details = Product::where('slug',$slug_name)->first();
        $related_product = Product::where('subcategory_id',$product_details->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        $review = Review::where('product_id',$product_details->id)->get();
        return view('website.details',compact('category','product_details','related_product','review'));
    }


    public function customerLogout(){
        Auth::logout();
        $message = array('message'=>'You are Logged out','alert-type'=>'success' );
        return redirect('/')->with($message);
    }


    public function review(Request $request) {
        $request->validate([
            'rating'=>'required',
            'review'=>'required'
        ]);

        $review_check = Review::where('product_id',$request->product_id)->first();
        if ($review_check) {
            $message = array('message'=>'Already you have leave a review this product !','alert-type'=>'error' );
            return redirect()->back()->with($message);
        }


        $review = Review::create([
            'user_id'      => auth::id(),
            'product_id'   => $request->product_id,
            'rating'       => $request->rating,
            'review'       => $request->review,
            'review_date'  => date('d-m-Y'),
            'review_month' => date('F'),
            'review_year'  => date('Y')
        ]);

        $message = array('message'=>'Thanks for your review !','alert-type'=>'success' );
        return redirect()->back()->with($message);

    }






}
