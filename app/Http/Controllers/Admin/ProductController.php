<?php

namespace App\Http\Controllers\Admin;

use Image;
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
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        $brand = Brand::all();
        $warehouse = Warehouse::all();
        return view('admin.product.index',compact('category','brand','warehouse'));
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
     * Product Fetch
     */

     public function getData(Request $request)
     {
         if ($request->ajax()) {
             $getData= "";
             $getData = Product::latest('id');
             if ($request->category_id) {
                $getData->where('category_id',$request->category_id); // request coming from index page
             }
             if ($request->brand_id) {
                $getData->where('brand_id',$request->brand_id);  // request coming from index page
             }
             if ($request->warehouse_id) {
                $getData->where('warehouse',$request->warehouse_id); // request coming from index page
             }
             if ($request->status ==1) {
                $getData->where('status',$request->status); // request coming from index page
             }
            //  if ($request->status ==0) {
            //     $getData->where('status',$request->status); // request coming from index page
            //  }

             // dd($getData);

             return DataTables::eloquent($getData)
             ->addIndexColumn()
             ->addColumn('operation', function($product){
                 $operation = '
                     <a href="'.route('admin.product.show',$product->id).'" data-id="'.$product->id.'" id="view-btn" class="btn btn-info btn-sm"><i class="fa fa-eye text-white"> </i></a>
                     <a href="'.route('admin.product.edit',$product->id).'" data-id="'.$product->id.'" id="edit-btn" class="btn btn-success btn-sm"><i class="fa fa-edit text-white"> </i></a>
                     <button data-id="'.$product->id.'" id="delete-btn" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white"> </i></button>
                 ';

                 return $operation;
             })

             ->addColumn('thumbnail', function($product) {
                $image = '<img width="40" height="40" src="' . asset('admin/product-images/'.$product->thumbnail).'">';
                return $image;
            })

             ->addColumn('category_id', function($product) {
                return $product->category->category_name;
            })

             ->addColumn('subcategory_id', function($product) {
                return $product->subcategory->subcategory_name;
            })

             ->addColumn('brand_id', function($product) {
                return $product->brand->brand_name;
            })

             ->addColumn('featured', function($product) {
                if ($product->featured ==1) {
                    return '<a class="deactive_featured" data-id="'.$product->id.'"> <i class="fa fa-thumbs-down text-danger"> </i> <span class="badge badge-warning"> Deactive </span>  </a>';
                }else {
                    return '<a class="active_featured" data-id="'.$product->id.'"> <i class="fa fa-thumbs-up text-success"> </i> <span class="badge badge-success"> Active </span>  </a>';
                }
            })

            ->addColumn('today_deal', function($product) {
                if ($product->today_deal ==1) {
                    return '<a class="deactivate_today_deal" data-id="'.$product->id.'"> <i class="fa fa-thumbs-down text-danger"> </i> <span class="badge badge-warning"> Deactive </span>  </a>';
                }else {
                    return '<a class="active_today_deal" data-id="'.$product->id.'"> <i class="fa fa-thumbs-up text-success"> </i> <span class="badge badge-success"> Active </span>  </a>';
                }
            })

             ->addColumn('status', function($product) {
                if ($product->status ==1) {
                    return '<a class="deactivate_status" data-id="'.$product->id.'"> <i class="fa fa-thumbs-down text-danger"> </i> <span class="badge badge-warning"> Deactive </span>  </a>';
                }else {
                    return '<a class="active_status" data-id="'.$product->id.'"> <i class="fa fa-thumbs-up text-success"> </i> <span class="badge badge-success"> Active </span>  </a>';
                }
            })


             ->addColumn('created_at', function($product){
                 return $product->created_at->format('d-m-Y');
             })

             ->rawColumns(['operation','thumbnail','category_id','subcategory_id','brand_id','featured','today_deal','status','created_at'])
             ->make(true);

             return view('admin.product.index');
         }
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::get();
        $brand = Brand::get();
        $pickup_point = PickupPoint::get();
        $warehouse = Warehouse::get();
        return view('admin.product.create',compact('category','brand','pickup_point','warehouse'));
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
            'size'             => $request->size,
            'description'      => $request->description,
            'video'            => $request->video,
            'thumbnail'        => $thumbnail_image,
            'images'           => implode(",",$imageArray),
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


    // featured active
    public function featuredActive(Request $request) {
        if ($request->ajax()) {
            $featured_active = Product::where('id',$request->data_id)->update(['featured'=>1]);
            $message = ['status'=>'success','message'=>'Data has been update'];
            return response()->json($message);
        }
    }
    // featured active
    public function featuredDeactivate(Request $request) {
        if ($request->ajax()) {
            $featured_deactive = Product::where('id',$request->data_id)->update(['featured'=>0]);
            $message = ['status'=>'success','message'=>'Data has been update'];
            return response()->json($message);
        }
    }
    // Today_deal active
    public function today_deal_active(Request $request) {
        if ($request->ajax()) {
            $today_deal_active = Product::where('id',$request->data_id)->update(['today_deal'=>1]);
            $message = ['status'=>'success','message'=>'Data has been update'];
            return response()->json($message);
        }
    }
    // Today_deal Deactivate
    public function today_deal_deactivate(Request $request) {
        if ($request->ajax()) {
            $today_deal_deactivate = Product::where('id',$request->data_id)->update(['today_deal'=>0]);
            $message = ['status'=>'success','message'=>'Data has been update'];
            return response()->json($message);
        }
    }
    // status active
    public function status_active(Request $request) {
        if ($request->ajax()) {
            $status_active = Product::where('id',$request->data_id)->update(['status'=>1]);
            $message = ['status'=>'success','message'=>'Data has been update'];
            return response()->json($message);
        }
    }
    // status Deactivate
    public function status_deactivate(Request $request) {
        if ($request->ajax()) {
            $status_deactivate = Product::where('id',$request->data_id)->update(['status'=>0]);
            $message = ['status'=>'success','message'=>'Data has been update'];
            return response()->json($message);
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product_show = Product::findOrFail($id);
        return view('admin.product.show',compact('product_show'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::get();
        $brand = Brand::get();
        $pickup_point = PickupPoint::get();
        $warehouse = Warehouse::get();
        $product_edit = Product::findOrFail($id);
        return view('admin.product.edit',compact('category','brand','pickup_point','warehouse','product_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product_update = Product::findOrFail($id);

         // $request->validate([
        //     'name'            => 'required',
        //     'code'            => 'required|max:55',
        //     'subcategory_id'  => 'required',
        //     'brand_id'        => 'required',
        //     'pickup_point_id' => 'required',
        //     'unit'            => 'required',
        //     'selling_price'   => 'required',
        //     'color'           => 'required',
        //     'description'     => 'required',
        // ]);


        // if ($request->hasFile('thumbnail_edit')) {
        //     $product_update['thumbnail'] = $this->file_update($request->file('thumbnail_edit'),'admin/product-images/',$product_update->thumbnail);
        // }
        // $thumbnail_edit = $this->file_upload($request->file('thumbnail_edit'),'admin/product-images/');

        if ($request->has('thumbnail_edit')) {

            file_exists('admin/product-images/'.$product_update->thumbnail) ? unlink('admin/product-images/'.$product_update->thumbnail) : false;
            $file = $request->file('thumbnail_edit');
            $extension = $file->getClientOriginalExtension();
            $imageName = uniqid(rand().time()).'.'.$extension;
            $file->move('admin/product-images/',$imageName);
        }else{
            $imageName = $product_update->thumbnail;
        }



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

        $subcategory = Subcategory::where('id',$request->subcategory_id)->first();

        $product_update->update([
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
            'size'             => $request->size,
            'description'      => $request->description,
            'video'            => $request->video,
            'thumbnail'        => $imageName,
            'images'           => implode(",",$imageArray),
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
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $product= Product::find($request->data_id);
            $product->delete();
            $message = ['status'=>'success','message'=>'Data has been update'];
            return response()->json($message);
        }
    }
}
