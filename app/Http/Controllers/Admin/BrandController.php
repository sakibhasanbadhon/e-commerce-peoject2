<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.brand.index');
    }

    /**
     * brand get Data
     */

     public function getData(Request $request)
     {
         if ($request->ajax()) {
             $getData = Brand::latest('id');
             // dd($getData);

             return DataTables::eloquent($getData)
             ->addIndexColumn()
             ->addColumn('operation', function($brand){
                 $operation = '
                     <button data-id="'.$brand->id.'" id="edit-btn" class="btn btn-success btn-sm">Edit</button>
                     <button data-id="'.$brand->id.'" id="delete-btn" class="btn btn-danger btn-sm">Delete</button>
                 ';

                 return $operation;
             })

             ->addColumn('brand_logo', function($brand) {
                $image = '<img width="80" height="80" src="' . ($brand->brand_logo != null ? asset('admin/brandImage/'.$brand->brand_logo) : 'https://via.placeholder.com/80') . '">';
                return $image;
            })

             ->addColumn('created_at', function($brand){
                 return $brand->created_at->format('d-m-Y');
             })

             ->rawColumns(['operation','created_at','brand_logo'])
             ->make(true);


         }
     }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $brand_logo = $this->file_upload($request->file('brand_logo'),'admin/brandImage/');

        $brand = Brand::create([
            'brand_name' => $request->brand_name,
            'brand_slug' => Str::slug($request->brand_name),
            'home_page' => $request->home_page,
            'brand_logo' => $brand_logo,
        ]);

        if ($brand) {
            $output=['status'=>'success','message'=>'Data has been Updated success'];
        }else {
            $output=['status'=>'error','message'=>'Something went wrong'];

        }


        return response()->json($output);
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
    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $brand = Brand::findOrFail($request->data_id);

            $home_page='
                <option value="0" '.($brand->home_page == 0 ? 'selected' : '').'>NO</option>
                <option value="1" '.($brand->home_page == 1 ? 'selected' : '').'>YES</option>
            ';
            return response()->json([
                'brand'=>$brand,
                'product_home'=>$home_page,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if($request->ajax()){
            $student = Brand::findOrFail($request->dataId);

            if ($request->has('avatar')) {
                file_exists('admin/brandImage/'.$student->brand_logo) ? unlink('admin/brandImage/'.$student->brand_logo) : false;
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension();
                $imageName = uniqid(rand().time()).'.'.$extension;
                $file->move('admin/brandImage/',$imageName);
            }else{
                $imageName = $student->brand_logo;
            }



            $data=$student->update([
                'brand_name'   => $request->brand_name,
                'home_page'   => $request->home_page,
                'brand_logo' => $imageName
            ]);

            if ($data) {
                $output=['status'=>'success','message'=>'Data has been Updated success'];
            }else{
                $output=['status'=>'error','message'=>'Something error'];
            }

            return response()->json($output);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->data_id);

            $Category_id = Brand::find($request->data_id);

            unlink('admin/brandImage/'.$Category_id->brand_logo);
        }

        $Category_id->delete();

        $message = ['status'=>'success','message'=>'Data has been Delete'];

        return response()->json($message);
    }
}
