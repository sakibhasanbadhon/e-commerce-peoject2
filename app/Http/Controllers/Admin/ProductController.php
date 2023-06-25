<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use PhpOption\Option;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use App\Models\PickupPoint;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::get();
        $brand = Brand::get();
        $pickup_point = PickupPoint::get();
        $warehouse = Warehouse::get();
        return view('admin.product.create',compact('category','brand','pickup_point','warehouse'));
    }

    // subcategory wise child category

    public function childCatSelect(Request $request) {
        if ($request->ajax()) {
            $childCat = ChildCategory::where('subcategory_id', $request->data_id)->get();
            $options = '';
            foreach ($childCat as $item) {
                $options .= '<option value="'.$item->id.'">'.$item->childCategory_name.'</option>';
            }

            return response()->json($options);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required',
            'code'            => 'required|unique:products|max:55',
            'subcategory_id'  => 'required',
            'brand_id'        => 'required',
            'pickup_point_id' => 'required',
            'unit'            => 'required',
            'selling_price'   => 'required',
            'color'           => 'required',
            'description'     => 'required',
        ]);

        $subcategory = Subcategory::where('id',$request->subcategory_id)->first();

        $thumbnail_image = $this->file_upload($request->file('thumbnail_image'),'admin/product-images/');
        // $images = $this->file_upload($request->file('images'),'admin/product-images/');


        $imageArray = array();
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            foreach ($file as $key => $image) {
                $file_extension = $image->getClientOriginalExtension();
                $image_rename = time().rand().'.'.$file_extension;
                $image->move('admin/product-images/',$image_rename);
                $imageArray[] = $image_rename;

            }
        }



        $product = Product::create([
            'name'             => $request->name,
            'slug'             => Str::slug($request->name),
            'code'             => $request->code,
            'category_id'      => $subcategory->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'childcategory_id' => $request->child_category_id,
            'brand_id'         => $request->brand_id,
            'pickup_point_id'  => $request->pickup_point_id,
            'tags'             => $request->tags,
            'unit'             => $request->unit,
            'purchase_price'   => $request->purchase_price,
            'selling_price'    => $request->selling_price,
            'discount_price'   => $request->discount_price,
            'warehouse'        => $request->warehouse,
            'stock_quantity'   => $request->stock,
            'color'            => $request->color,
            'images'           => implode(",",$imageArray),
            'size'             => $request->size,
            'description'      => $request->description,
            'video'            => $request->video,
            'thumbnail'        => $thumbnail_image,
            'featured'         => $request->featured,
            'today_deal'       => $request->today_deal,
            'status'           => $request->status,
            'admin_id'         => Auth::id(),
            'date'             => date('d-m-Y'),
            'month'            => date('F'),
        ]);


        $notification = array('message'=>'Product Updated !','alert-type' => 'success');

        return redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
