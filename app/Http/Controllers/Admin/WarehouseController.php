<?php

namespace App\Http\Controllers\Admin;

use App\Models\Warehouse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.warehouse.index');
    }

    /**
     * warehouse show data
     */

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $getData = Warehouse::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('operation', function($warehouse){
                $operation = '
                    <button data-id="'.$warehouse->id.'" id="edit-btn" class="btn btn-success btn-sm">Edit</button>
                    <button data-id="'.$warehouse->id.'" id="delete-btn" class="btn btn-danger btn-sm">Delete</button>
                ';

                return $operation;
            })

            ->addColumn('created_at', function($warehouse){
                return date('d-M-y', strtotime($warehouse->created_at));

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $warehouse = Warehouse::updateOrCreate([
            'id' => $request->dataId
        ],
        [
            'warehouse_name' => $request->warehouse_name,
            'warehouse_address' => $request->warehouse_address,
            'warehouse_phone' => $request->warehouse_phone
        ]);


        if ($warehouse) {
            $output=['status'=>'success','message'=>'Warehouse added success'];
        }else {
            $output=['status'=>'error','message'=>'OPPS! Warehouse not added'];

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
            $category = Warehouse::findOrFail($request->data_id);
            return response()->json($category);
        }

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
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->data_id);

            $warehouse_id = Warehouse::find($request->data_id);
        }

        $warehouse_id->delete();

        if ($warehouse_id) {
            $message = ['status'=>'success','message'=>'Data has been Delete'];
        }else {
            $message = ['status'=>'success','message'=>'Data has been Delete'];
        }



        return response()->json($message);
    }
}
