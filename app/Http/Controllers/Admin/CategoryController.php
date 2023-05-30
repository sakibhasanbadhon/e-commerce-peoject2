<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
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
                    <a href="" id="edit-btn" class="btn btn-success btn-sm">Edit</a>
                    <a href="" class="btn btn-danger btn-sm">Delete</a>
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
            'category_slug' => $request->slug,
        ]);

        if ($category) {
            $message = array('message'=>'Data update successfully','alert-type'=>'success' );

        }

        return back()->with($message);
    }



}
