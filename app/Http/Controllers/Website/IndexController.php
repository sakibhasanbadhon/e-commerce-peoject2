<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    // root page
    public function index()
    {
        $category = Category::all();
        $slider_product = Product::where('status',1)->where('slider_show',1)->latest()->first();
        $today_deal = Product::where('status',1)->where('today_deal',1)->latest()->get();
        $featured = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $popular_product = Product::where('status',1)->orderBy('product_views','DESC')->limit(16)->get();
        $trendy_product = Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(8)->get();
        $category_home = Category::where('home_page',1)->get();
        $brand = Brand::where('home_page',1)->limit(24)->get();
        // recently product
        $random_product = Product::where('status',1)->inRandomOrder()->limit(12)->get();



        return view('website.index', compact(
                'category',
                'slider_product',
                'featured',
                'today_deal',
                'popular_product',
                'trendy_product',
                'category_home',
                'brand',
                'random_product'
            ));
    }


    // single product page

    public function productDetails($slug_name){
        $category = Category::all();
        $product_details = Product::where('slug',$slug_name)->first();
        Product::where('slug',$slug_name)->increment('product_views');
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






    public function  quickView(Request $request) {

            $product = Product::where('id',$request->button_id)->first();
            return view('website.include.quick-view',compact('product'));

        }





    // public function categoryWiseProduct($category){
    //     $arrival_product = Product::where('category_id', $category->id)->get();
    //     return view('website.index', compact('arrival_product'));
    // }




}


