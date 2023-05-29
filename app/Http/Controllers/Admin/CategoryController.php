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
            $getData = Category::orderBy('id','DESC')->get();
            dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('operation', function($category){
                $operation = '
                    <a href="" class="btn btn-success btn-sm">Edit</a>
                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                ';

                return $operation;
            })

            ->rowColumns(['operation'])
            ->make(true);


        }
    }



}
