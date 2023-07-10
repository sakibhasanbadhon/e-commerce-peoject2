<?php

namespace App\Http\Controllers\Website;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;

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
        return view('website.details',compact('category','product_details','related_product'));
    }


}
