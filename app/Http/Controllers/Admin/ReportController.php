<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function orderView() {
        return view('admin.report.order_report');

    }

    public function orderGetData(Request $request) {
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

            ->rawColumns(['status','date','total'])
            ->make(true);

        }
    }


    // Product Section

    public function ProductView() {
        $category = Category::all();
        $brand = Brand::all();
        $warehouse = Warehouse::all();
        return view('admin.report.product_report',compact('category','brand','warehouse'));

    }

    public function productGetData(Request $request)
     {
         if ($request->ajax()) {
             $getData= "";
             $getData = Product::latest('id');
             if ($request->category_id) {
                $getData->where('category_id',$request->category_id); // request coming from index page
             }
             if ($request->brand_id) {
                $getData->where('brand_id',$request->brand_id);  // request coming from index page
             }
             if ($request->warehouse_id) {
                $getData->where('warehouse',$request->warehouse_id); // request coming from index page
             }
             if ($request->status) {
                $getData->where('status',$request->status); // request coming from index page
             }

            return DataTables::eloquent($getData)
            ->addIndexColumn()

            ->addColumn('category_id', function($product) {
                return $product->category->category_name;
            })

            ->addColumn('status', function($product) {
                if ($product->status ==1) {
                    return '<a class="deactivate_status" data-id="'.$product->id.'"> <i class="fa fa-thumbs-down text-danger"> </i> <span class="badge badge-warning"> Deactive </span>  </a>';
                }else {
                    return '<a class="active_status" data-id="'.$product->id.'"> <i class="fa fa-thumbs-up text-success"> </i> <span class="badge badge-success"> Active </span>  </a>';
                }
            })


            ->addColumn('created_at', function($product){
                return $product->created_at->format('d-m-Y');
            })

            ->rawColumns(['category_id','status','created_at'])
            ->make(true);

        }
    }


    // Customer view
    public function customerView() {
        return view('admin.report.customer_report');

    }

    public function customerGetData(Request $request) {
        if ($request->ajax()) {
            $getData = User::latest('id');
            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('date', function($customer) {
                return date('d-M-Y', strtotime($customer->date));
            })

            ->rawColumns(['date'])
            ->make(true);

        }
    }





}
