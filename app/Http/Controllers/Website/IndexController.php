<?php

namespace App\Http\Controllers\Website;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $slider_product = Product::where('slider_show',1)->latest()->first();
        return view('website.index', compact('category','slider_product'));
    }




}
