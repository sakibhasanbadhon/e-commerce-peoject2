<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.coupon.index');
    }

    /**
     * coupon show data
     */

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $getData = Coupon::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('operation', function($coupon){
                $operation = '
                    <button data-id="'.$coupon->id.'" id="edit-btn" class="btn btn-success btn-sm">Edit</button>
                    <button data-id="'.$coupon->id.'" id="delete-btn" class="btn btn-danger btn-sm">Delete</button>
                ';

                return $operation;
            })

            ->addColumn('status', function($coupon){
                if($coupon->status == 1) {
                    return '<span class=" badge badge-success"> Active </span>';
                } else {
                    return '<span class="badge badge-warning"> Inactive </span>';
                }
            })

            ->addColumn('created_at', function($coupon){
                return date('d-M-y', strtotime($coupon->created_at));

            })

            ->rawColumns(['operation','created_at','status'])
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
        $coupon = Coupon::updateOrCreate([
            'id' => $request->dataId
        ],
        [
            'coupon_code'   => $request->coupon_code,
            'type'          => $request->type,
            'coupon_amount' => $request->coupon_amount,
            'valid_date'    => $request->valid_date,
            'status'        => $request->status
        ]);


        if ($coupon) {
            $output=['status'=>'success','message'=>'Coupon added success'];
        }else {
            $output=['status'=>'error','message'=>'OPPS! Coupon not added'];

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
            $coupon = Coupon::findOrFail($request->data_id);
            $type = '
                <select class="form-control" name="type" required>
                    <option value="1" ' . ($coupon->type == 1 ? 'selected' : '') . '>Fixed</option>
                    <option value="2" ' . ($coupon->type == 2 ? 'selected' : '') . '>Percentage</option>
                </select>
            ';

            $status = '
                <select class="form-control" name="status" required>
                    <option value="1" ' . ($coupon->status == 1 ? 'selected' : '') . '>Active</option>
                    <option value="0" ' . ($coupon->status == 0 ? 'selected' : '') . '>Pending</option>
                </select>
            ';

            return response()->json([
                'coupon' => $coupon,
                'type' => $type,
                'status' => $status,
            ]);
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

            $coupon_id = Coupon::find($request->data_id);
        }

        $coupon_id->delete();

        if ($coupon_id) {
            $message = ['status'=>'success','message'=>'Data has been Delete'];
        }else {
            $message = ['status'=>'success','message'=>'Data has been Delete'];
        }



        return response()->json($message);
    }
}
