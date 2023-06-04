<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory = DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
            ->select('subcategories.*','categories.category_name')->get();
        return view('admin.category.subcategory.index',['subcategories'=>$subcategory]);
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
                    <button data-id="'.$subcategory->id.'" id="edit-btn" class="btn btn-success btn-sm">Edit</button>
                    <button data-id="'.$subcategory->id.'" id="delete-btn" class="btn btn-danger btn-sm">Delete</button>
                ';

                return $operation;
            })

            ->addColumn('created_at', function($subcategory){
                return $subcategory->created_at->format('d-m-Y');
            })

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
        $category = Subcategory::updateOrCreate([
            'id' => $request->dataId
        ],
        [
            'subcategory_name' => $request->name,
            'subcategory_slug' => Str::slug($request->slug)
        ]);


        return response()->json();

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
