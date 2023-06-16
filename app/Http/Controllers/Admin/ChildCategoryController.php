<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ChildCategoryController extends Controller
{
    private $myVariable;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::latest()->get();
        return view('admin.category.childCategory.index',['category'=>$category]);
    }

    public function getData(Request $request)
    {
       if ($request->ajax()) {
           $getData = ChildCategory::latest('id');
           // dd($getData);

           return DataTables::eloquent($getData)
           ->addIndexColumn()
           ->addColumn('operation', function($childCategory){
               $operation = '
                   <a href="'.route('admin.childCategory.edit',$childCategory->id).'" data-id="'.$childCategory->id.'" id="edit-btn" class="btn btn-success btn-sm">Edit </a>
                   <button data-id="'.$childCategory->id.'" id="delete-btn" class="btn btn-danger btn-sm">Delete</button>
               ';

               return $operation;
           })

           ->addColumn('category_id', function($childCategory){
               return $childCategory->category->category_name;
           })

           ->addColumn('subcategory_id', function($childCategory){
               return $childCategory->subcategory->subcategory_name;
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
     *
     * category wise subcategory
    */

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }


    // public function getSubcategories(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $sub_categories = Subcategory::where('category_id', $request->category_id)->get();
    //         $output = '<option value="">Select Please</option>';
    //         if (!$sub_categories->isEmpty()) {
    //             foreach($sub_categories as $category){
    //                 $output .= '<option value="'.$category->id.'">'.$category->subcategory_name.'</option>';
    //             }
    //         }

    //     // return response()->json($output);
    //     }


    // }

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
        $request->validate([
            'category_id'        => 'required',
            'subcategory_id'     => 'required',
            'childCategory_name' => 'required'
        ]);

        $childCategory= ChildCategory::create([
            'childCategory_name' => $request->childCategory_name,
            'childCategory_slug' => Str::slug($request->childCategory_name),
            'category_id'        => $request->category_id,
            'subcategory_id'     => $request->subcategory_id,
        ]);

        if ($childCategory) {
            $output=['status'=>'success','message'=>'Child-Category Added success'];
        }else {
            $output=['status'=>'error','message'=>'OPPS! Child-Category not Added !'];

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
    public function edit($id)
    {

        $category = Category::latest()->get();
        // $subcategory = Subcategory::where('category_id', $id)->get();

        $subcategory = Subcategory::latest()->get();
        $childCategory = ChildCategory::find($id);

        return view('admin.category.childCategory.edit',compact('category','subcategory','childCategory'));


        // if ($request->ajax()) {

        //     $category = Category::latest()->get();
        //     $subcategory = Subcategory::latest()->get();
        //     $childCategory_edit = ChildCategory::findOrFail($request->data_id);
        //     $output = '';
        //     foreach ($childCategory_edit as $key => $categories) {
        //         $output .= '<option id="category_option> "'.$categories->category_name.'" </option>';
        //     }

        //     return response()->json($output);
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $childCategory = ChildCategory::findOrFail($id);

        $childCategory->update([
            'childCategory_name' => $request->childCategory_name,
            'childCategory_slug' => Str::slug($request->childCategory_name),
            'category_id' => $request->category_id,
            'subcategory_id'=> $request->subcategory_id,

        ]);

        if ($childCategory) {
            $notification = array('message'=>'Child-Category added Success.','alert-type' => 'success');
        }else {
            $notification = array('message'=>'OPPS ! Child-Category Not added !','alert-type' => 'error');

        }

        return redirect()->back()->with($notification);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $childCategory = ChildCategory::find($request->data_id);
            $childCategory->delete();

            if ($childCategory) {
                $output=['status'=>'success','message'=>'Child-Category Delete success'];
            }else {
                $output=['status'=>'error','message'=>'OPPS! Child-Category not Delete !'];

            }


            return response()->json($output);
        }
    }
}
