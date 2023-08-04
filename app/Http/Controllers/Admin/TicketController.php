<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Reply;
use Yajra\DataTables\Facades\DataTables;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.ticket.index');
    }

    public function ticketGet(Request $request)
    {
        if ($request->ajax()) {
            // $getData= "";
            // $getData = DB::table('tickets')->leftJoin('users','tickets.user_id','user.id')->get();

            $getData = Ticket::latest('id');

            if ($request->type) {
                $getData->where('service',$request->type); // request coming from index page
            }

            if ($request->date) {
                $getData->where('date',$request->date); // request coming from index page
            }

            if ($request->status) {
               $getData->where('status',$request->status); // request coming from index page
            }
            // if ($request->status ==1) {
            //    $getData->where('status',1); // request coming from index page
            // }
            // if ($request->status ==2) {
            //    $getData->where('status',2); // request coming from index page
            // }

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('operation', function($ticket){
                $operation = '
                    <a href="'.route('admin.ticket.show',$ticket->id).'"  id="view-btn" class="btn btn-info btn-sm"><i class="fa fa-eye text-white"> </i></a>
                    <button data-id="'.$ticket->id.'" id="delete-btn" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white"> </i></button>
                ';

                return $operation;
            })

            ->addColumn('name', function($ticket) {
                return $ticket->user->name;
            })

            ->addColumn('date', function($ticket) {
                return date('d-M-Y', strtotime($ticket->date));
            })

            ->addColumn('status', function($ticket) {

                if ($ticket->status ==0) {
                return '<span class="badge badge-warning"> Pending </span>';
               }elseif($ticket->status ==1){
                return '<span class="badge bg-secondary"> Close </span>';
               }elseif($ticket->status ==2){
                return '<span class="badge badge-danger"> Replied </span>';
               }

           })

        //     ->addColumn('thumbnail', function($ticket) {
        //        $image = '<img width="40" height="40" src="' . asset('admin/ticket-images/'.$ticket->thumbnail).'">';
        //        return $image;
        //    })

            // ->addColumn('created_at', function($ticket){
            //     return $ticket->created_at->format('d-m-Y');
            // })

            ->rawColumns(['operation','status'])
            ->make(true);

        }
    }

    /**
     *
     */
    public function ticketShow($id)
    {
        $show= Ticket::find($id)->first();
        return view('admin.ticket.show',compact('show'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function replyStore(Request $request)
    {
        $request->validate([
            'message'=>'required'
        ]);

        $ticketData = [
            'user_id' => 0,
            'message' => $request->message,
            'ticket_id' => $request->ticket_id,
            'reply_date'  => date('Y-m-d'),
        ];

        if ($request->hasFile('image')) {
            // Store the uploaded image in the appropriate directory
            $ticketData['image'] = $this->file_upload($request->file('image'), 'admin/ticket-image/');
        }
        $ticket = Reply::create($ticketData);


        $message = array('message'=>'Replied Done','alert-type'=>'success' );
        return redirect()->back()->with($message);
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
