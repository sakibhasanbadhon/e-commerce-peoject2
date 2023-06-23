<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\PickupPoint;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use PhpOption\Option;

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

    public function childCatSelect(Request $request) {
        if ($request->ajax()) {
            $childCat = ChildCategory::where('subcategory_id', $request->data_id)->get();
            $options = '';
            foreach ($childCat as $item) {
                $options .= '<option>'.$item->childCategory_name.'</option>';
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
        //
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
