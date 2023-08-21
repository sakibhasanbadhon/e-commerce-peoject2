<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
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
            if ($request->date) {
                $getData->where('date',$request->date); // request coming from index page
            }




            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('operation', function($order){
                $operation = '
                    <a href="'.route('admin.ticket.show',$order->id).'"  id="view-btn" class="btn btn-info btn-sm"><i class="fa fa-eye text-white"> </i></a>
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

}
