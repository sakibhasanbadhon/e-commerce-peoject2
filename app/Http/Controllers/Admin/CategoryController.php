<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.category.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $getData = Category::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('operation', function($category){
                $operation = '
                    <button id="edit-btn" class="btn btn-success btn-sm">Edit</button>
                    <button data-id="'.$category->id.'" id="delete-btn" class="btn btn-danger btn-sm">Delete</button>
                ';

                return $operation;
            })

            ->addColumn('created_at', function($category){
                return $category->created_at->format('d-m-Y');
            })

            ->rawColumns(['operation','created_at'])
            ->make(true);


        }
    }



    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $category = Category::create([
            'category_name' => $request->name,
            'category_slug' => Str::slug($request->slug),
        ]);

        if ($category) {
            $output=['status'=>'success','message'=>'Data has been Updated success'];
        }else {
            $output=['status'=>'error','message'=>'Something went wrong'];

        }


        return response()->json($output);

    }


    // data delete


    public function destroy(Request $request)
    {

        if ($request->ajax()) {
            // dd($request->data_id);

            $Category_id = Category::find($request->data_id);
        }

        $Category_id->delete();

        $message = ['status'=>'success','message'=>'Data has been Delete'];

        return response()->json($message);
    }



}
