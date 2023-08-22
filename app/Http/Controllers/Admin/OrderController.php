<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderReceivedMail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index() {
        return view('admin.orders.index');
    }

    public function getData(Request $request) {
        if ($request->ajax()) {
            // $getData= "";

            $getData = Order::latest('id');

            if ($request->status) {
               $getData->where('status',$request->status); // request coming from index page
            }

            if ($request->payment_type) {
               $getData->where('payment_type',$request->payment_type); // request coming from index page
            }
            if ($request->date) {
                $getData->where('date',$request->date); // request coming from index page
            }

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('operation', function($order){
                $operation = '
                    <button data-id="'.$order->id.'" id="view-btn" class="btn btn-secondary btn-sm"><i class="fa fa-eye text-white"> </i></button>
                    <button data-id="'.$order->id.'" id="edit-btn" class="btn btn-info btn-sm"> <i class="fa fa-edit text-white"> </i></button>
                    <button data-id="'.$order->id.'" id="delete-btn" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white"> </i></button>
                ';

                return $operation;
            })

            // ->addColumn('name', function($ticket) {
            //     return $ticket->user->name;
            // })

            ->addColumn('date', function($order) {
                return date('d-M-Y', strtotime($order->date));
            })

            ->addColumn('status', function($order) {

                if ($order->status ==0) {
                return '<span class="badge badge-warning"> Pending </span>';
               }elseif($order->status ==1){
                return '<span class="badge bg-success"> Received </span>';
               }elseif($order->status ==2){
                return '<span class="badge badge-primary"> Shipped </span>';
               }elseif($order->status ==3){
                return '<span class="badge badge-info"> Complete </span>';
               }elseif($order->status ==4){
                return '<span class="badge badge-secondary"> Return </span>';
               }elseif($order->status ==5){
                return '<span class="badge badge-danger"> Cancel </span>';
               }

           })

           ->addColumn('total', function($order) {
                if (!$order->main_balance==null) {
                    return $order->main_balance;
                } else {
                    return $order->total;
                }

            })

            //     ->addColumn('thumbnail', function($ticket) {
            //        $image = '<img width="40" height="40" src="' . asset('admin/ticket-images/'.$ticket->thumbnail).'">';
            //        return $image;
            //    })

            ->rawColumns(['operation','status','date','total'])
            ->make(true);

        }
    }



    public function edit(Request $request) {
        if ($request->ajax()) {
            $order= Order::findOrFail($request->data_id);

            $status = '
                <option value="0" ' . ($order->status == 0 ? 'selected' : '') . '> Pending</option>
                <option value="1" ' . ($order->status == 1 ? 'selected' : '') . '> Received</option>
                <option value="2" ' . ($order->status == 2 ? 'selected' : '') . '> Shipped</option>
                <option value="3" ' . ($order->status == 3 ? 'selected' : '') . '> Complete</option>
                <option value="4" ' . ($order->status == 4 ? 'selected' : '') . '> Return</option>
                <option value="5" ' . ($order->status == 5 ? 'selected' : '') . '> Cancel</option>
            ';

            return response()->json([
                'orders'=>$order,
                'order_status' => $status
            ]);
        }
    }


    public function update(Request $request){

        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'order_status' => 'required'
        ]);

        $order_id = Order::findOrFail($request->dataId);

        $order = $order_id->update([
            'c_name' => $request->name,
            'c_address' => $request->address,
            'c_phone' => $request->phone,
            'c_email' => $request->email,
            'status' => $request->order_status,
        ]);

        if ($request->order_status==1) {
            Mail::to($request->email)->send(new OrderReceivedMail($order));
        }

        if ($order) {
            $output=['status'=>'success','message'=>'Data has been Updated success'];
        }else {
            $output=['status'=>'error','message'=>'Something went wrong'];

        }

        return response()->json($output);
    }


    public function view(Request $request){
        // dd($request->button_id);
        $order = Order::where('id',$request->button_id)->first();
        $order_details = OrderDetail::where('order_id',$request->button_id)->get();
        return view('admin.orders.viewModal',compact('order','order_details'));
    }


    public function statusUpdate(Request $request) {
        // dd($request->order_id);

        $order_id = Order::findOrFail($request->view_order_id);
        $order = $order_id->update([
            'status' => $request->view_order_status,
        ]);

        if ($request->view_order_status==1) {
            Mail::to($request->order_email)->send(new OrderReceivedMail($order));
        }

        if ($order) {
            $output=['status'=>'success','message'=>'Order status Updated success'];
        }else {
            $output=['status'=>'error','message'=>'Something went wrong'];

        }

        return response()->json($output);
    }


    // public function orderDelete(Request $request) {
    //     if ($request->ajax()) {
    //         $order = Order::where('id',$request->dataId);
    //         $order_details = OrderDetail::where('order_id',$request->dataId);
    //     }

    //     $order->delete();
    //     $order_details->delete();

    //     $output=['status'=>'success','message'=>'Order Record has been delete'];
    //     return response()->json($output);
    // }

    public function orderDelete(Request $request) {
        if ($request->ajax()) {
            $order = Order::find($request->data_id);
            $order_details = OrderDetail::where('order_id', $request->data_id);
            $order->delete();
            $order_details->delete();

            $output = ['status' => 'success', 'message' => 'Order Record has been deleted'];
            return response()->json($output);
        }
    }


}
