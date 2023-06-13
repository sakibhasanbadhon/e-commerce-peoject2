<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $subcategory = DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
        //     ->select('subcategories.*','categories.category_name')->get();

        // $subcategory = Subcategory::with('category')->orderBy('id','DESC')->get();

        $subcategory = Subcategory::get();


        // return $subcategory;

        $category = Category::all();

        return view('admin.category.subcategory.index', compact('subcategory','category'));
    }


    /**
     * subcategory get data
     */

     public function getData(Request $request)
     {
        if ($request->ajax()) {
            $getData = Subcategory::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('operation', function($subcategory){
                $operation = '
                    <a href="'.route('admin.subcategory.edit',$subcategory->id).'" data-id="'.$subcategory->id.'" id="edit-btn" class="btn btn-success btn-sm">Edit </a>
                    <button data-id="'.$subcategory->id.'" id="delete-btn" class="btn btn-danger btn-sm">Delete</button>
                ';

                return $operation;
            })

            ->addColumn('category_id', function($subcategory){

                return $subcategory->category->category_name;

            })


            // ->addColumn('created_at', function($subcategory){
            //     return $subcategory->created_at->format('d-m-Y');
                        // return date_formats('d-m-Y',$subcategory->created_at);
            // })

            ->rawColumns(['operation','created_at'])
            ->make(true);


        }
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $category = Subcategory::create([
            'subcategory_name' => $request->name,
            'subcategory_slug' => Str::slug($request->name),
            'category_id'       => $request->category_id
        ]);

        $notification = array('message'=>'Subcategory inserted!','alert-type' => 'success');

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
    public function edit($id)
    {
        $category = Category::latest()->get();
        $subcategory = Subcategory::find($id);
        return view('admin.category.subcategory.edit',['category'=>$category,'subcategory'=>$subcategory]);




    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $subcategory =Subcategory::findOrFail($id);

        $subcategory->update([
            'category_id' => $request->category_id,
            'subcategory_name'=> $request->subcategory_name,
            'subcategory_slug'=> Str::slug($request->subcategory_name)
        ]);

       $notification = array('message'=>'Subcategory Updated !','alert-type' => 'success');

        return redirect()->back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->data_id);

            $Category_id = Subcategory::find($request->data_id);
        }

        $Category_id->delete();

        $message = ['status'=>'success','message'=>'Subcategory has been Deleted !'];

        return response()->json($message);
    }
}
