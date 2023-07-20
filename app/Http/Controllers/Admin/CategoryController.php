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
                    <button data-id="'.$category->id.'" id="edit-btn" class="btn btn-success btn-sm">Edit</button>
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

        // $request->validate([
        //     'name' => 'required',
        //     'slug' => 'required',
        // ]);
        $category = Category::updateOrCreate([
            'id' => $request->dataId
        ],
        [
            'category_name' => $request->name,
            'category_slug' => Str::slug($request->name),
            'home_page' => $request->home_page
        ]);


        if ($category) {
            $output=['status'=>'success','message'=>'Data has been Updated success'];
        }else {
            $output=['status'=>'error','message'=>'Something went wrong'];

        }


        return response()->json($output);

    }


    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::findOrFail($request->data_id);

            $home_page='
                <option value="0" '.($category->home_page == 0 ? 'selected' : '').'>NO</option>
                <option value="1" '.($category->home_page == 1 ? 'selected' : '').'>YES</option>
            ';
            return response()->json([
                'category'=>$category,
                'category_home_page' =>$home_page
            ]);
        }


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
