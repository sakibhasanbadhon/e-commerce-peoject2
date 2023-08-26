<?php

namespace App\Http\Controllers\Website;

use App\Models\Page;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\Customerreview;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetail;

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
        $customer_review = Customerreview::where('status',1)->orderBy('id','DESC')->limit(12)->get();
        $campaign = Campaign::where('status',1)->orderBy('id','DESC')->first();


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
                'random_product',
                'customer_review',
                'campaign'
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





    public function categoryWiseProduct($id){
        $categoryItem = Category::where('id',$id)->first();
        $subcategory = Subcategory::where('category_id',$id)->get();
        $brand = Brand::get();
        $products = Product::where('category_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(12)->get();
        $category = Category::get(); //for navbar

        return  view('website.category.category_product',compact(
            'subcategory',
            'products',
            'brand',
            'category',
            'random_product',
            'categoryItem'
        ));

    }

    public function subcategoryWiseProduct($id){
        $subcategory = Subcategory::where('id',$id)->first();
        $childcategory = ChildCategory::where('subcategory_id',$id)->get();
        $brand = Brand::get();
        $products = Product::where('subcategory_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(12)->get();
        $category = Category::get(); //for navbar

        return  view('website.category.subcategory_product',compact(
            'subcategory',
            'childcategory',
            'brand',
            'products',
            'random_product',
            'category',
        ));

    }

    public function childcategoryWiseProduct($id){
        // $subcategory = Subcategory::where('id',$id)->first();
        $childcategory = ChildCategory::where('id',$id)->first();
        $brand = Brand::get();
        $products = Product::where('childcategory_id',$id)->paginate(4);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(12)->get();
        $category = Category::get(); //for navbar

        return  view('website.category.childcategory_product',compact(
            'childcategory',
            'brand',
            'products',
            'random_product',
            'category',
        ));

    }


    public function brandWiseProduct($id){
        $brandItem = Brand::where('id',$id)->first();
        // $subcategory = Subcategory::get();
        $brand = Brand::get();
        $products = Product::where('brand_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(12)->get();
        $category = Category::get(); //for navbar

        return  view('website.category.brand_product',compact(
            // 'subcategory',
            'brandItem',
            'brand',
            'products',
            'random_product',
            'category',
        ));

    }

    public function customer(){
        $orders = DB::table('orders')->where('user_id',Auth::id())->orderBy('id','DESC')->take(10)->get();

        $total_orders = DB::table('orders')->where('user_id',Auth::id())->count();
        $complete_orders = DB::table('orders')->where('user_id',Auth::id())->where('status',3)->count();
        $return_orders = DB::table('orders')->where('user_id',Auth::id())->where('status',4)->count();
        $cancel_orders = DB::table('orders')->where('user_id',Auth::id())->where('status',5)->count();

        return view('website.user.dashboard',compact('orders','total_orders','complete_orders','return_orders','cancel_orders'));
    }

    public function writeReview(){
        return view('website.user.write_review');
    }

    public function writeReviewStore(Request $request) {
        $request->validate([
            'name' => 'required',
            'review' => 'required',
            'rating' => 'required',
        ]);

        $review_check = Customerreview::where('user_id', auth::id())->first();
        if ($review_check) {

            $message = array('message'=>'Already your review Exist','alert-type'=>'error');
            return redirect()->back()->with($message);
        }else {
            $customer = Customerreview::create([
                'user_id' => auth::id(),
                'name'    => $request->name,
                'review'  => $request->review,
                'rating'  => $request->rating,
            ]);

            $message = array('message'=>'Your Review submit','alert-type'=>'success');
            return redirect()->back()->with($message);
        }

    }




    // footer view page

    public function footerViewPage($page_slug) {
        $category= Category::get();
        $page = Page::where('page_slug',$page_slug)->first();
        return view('website.page',compact('page','category'));

    }


    public function newsletter(Request $request){
        $email = DB::table('newsletters')->where('email',$request)->first();
        if ($email) {
            $message = array('message'=>'Email already exist','alert-type'=>'error');
            return redirect()->back()->with($message);
        }else {
            DB::table('newsletters')->insert([
                'email' => $request->email
            ]);
            $message = array('message'=>'Thanks For Subscription','alert-type'=>'success');
            return redirect()->back()->with($message);
        }
    }




    public function orderTracking() {
        return view('website.tracking.orderTracking');

    }

    public function checkOrder(Request $request) {
        $order_check = Order::where('order_id',$request->order_id)->first();
        if ($order_check) {
            $order = Order::where('order_id',$request->order_id)->first();
            $order_details = OrderDetail::where('order_id',$order->id)->get();
            return view('website.tracking.tracking_details',compact('order','order_details'));
        }else {
            $message = array('message'=>'Invalid order id. try again !','alert-type'=>'error' );
            return redirect()->back()->with($message);
        }

    }


    //  blog page section

    public function blogPage() {
        $category = Category::all();
        $blogs = Blog::where('status',1)->orderBy('id','desc')->get();
        return view('website.blog.blog',['category'=>$category,'blogs'=>$blogs]);
    }


    public function blogDetails($slug) {
        $category = Category::all();
        $blogs = Blog::where('slug',$slug)->first();
        $similar = Blog::where('blog_category_id',$blogs->blog_category_id)->take(10)->get();
        return view('website.blog.blog_single',
        [
            'category'=>$category,
            'blogs'=>$blogs,
            'similar'=>$similar
        ]);


    }



}


