<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PickupPoint;
use Yajra\DataTables\Facades\DataTables;

class PickupPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pickupPoint.index');
    }

    /**
     * pickup_point show data
     */

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $getData = PickupPoint::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('operation', function($pickup_point){
                $operation = '
                    <button data-id="'.$pickup_point->id.'" id="edit-btn" class="btn btn-success btn-sm">Edit</button>
                    <button data-id="'.$pickup_point->id.'" id="delete-btn" class="btn btn-danger btn-sm">Delete</button>
                ';

                return $operation;
            })

            ->addColumn('created_at', function($pickup_point){
                return date('d-M-y', strtotime($pickup_point->created_at));

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
        $pickup_point = PickupPoint::updateOrCreate([
            'id' => $request->dataId
        ],
        [
            'pickup_point_name' => $request->pickup_point_name,
            'address'           => $request->address,
            'phone'             => $request->phone,
            'another_phone'     => $request->another_phone,

        ]);


        if ($pickup_point) {
            $output=['status'=>'success','message'=>'Pickup Point added success'];
        }else {
            $output=['status'=>'error','message'=>'OPPS! Pickup point not added'];

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
            $pickup_point = PickupPoint::findOrFail($request->data_id);

            return response()->json($pickup_point);
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

            $pickup_point_id = PickupPoint::find($request->data_id);
        }

        $pickup_point_id->delete();

        if ($pickup_point_id) {
            $message = ['status'=>'success','message'=>'Data has been Delete'];
        }else {
            $message = ['status'=>'success','message'=>'Data has been Delete'];
        }



        return response()->json($message);
    }
}
