<?php

namespace App\Http\Controllers\Website;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profileSetting() {
        return view('website.user.setting');

    }


    public function passwordChange(Request $request) {
        $validation = $request->validate([
            'old_password' => 'required',
            'password'     => 'required|confirmed',
            // 'password_confirmation' => 'required'

        ]);

        $authPassword = auth::user();
        if (Hash::check($request->old_password, $authPassword->password)) {
            $authId = User::findOrFail($authPassword->id);
            // $authId->password = Hash::make($request->password);
            // $authId->save();
            $authId->update([
                'password'=> Hash::make($request->password)
            ]);
            Auth::logout();
            $message = array('message'=>'You are Logged out','alert-type'=>'success' );
            return redirect('login')->with($message);
        }else {
            $message = array('message'=>'Old password not match','alert-type'=>'error' );
            return redirect()->back()->with($message);
        }

    }



    public function shippingStore(Request $request) {

        $shipping =Shipping::create([
            'user_id'          => auth::id(),
            'shipping_name'    => $request->name,
            'shipping_phone'   => $request->phone,
            'shipping_address' => $request->email,
            'shipping_country' => $request->address,
            'shipping_city'    => $request->country,
            'shipping_zipcode' => $request->city,
            'shipping_email'   => $request->zipcode
        ]);

        $message = array('message'=>'Shipping details Update','alert-type'=>'success' );
            return redirect()->back()->with($message);


    }


    public function myOrder() {
        $orders = DB::table('orders')->where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('website.user.my_order',compact('orders'));
    }

    public function openTicket() {
        $tickets = Ticket::where('user_id',Auth::id())->orderBy('id','DESC')->take(10)->get();
        return view('website.user.ticket',compact('tickets'));
    }

    public function ticketStore(Request $request) {
        $request->validate([
            'subject'=> 'required',
        ]);

        $ticketData = [
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'service' => $request->service,
            'priority' => $request->priority,
            'message' => $request->message,
            'status' => 0,
            'date'  => date('Y-m-d'),
        ];

        if ($request->hasFile('image')) {
            // Store the uploaded image in the appropriate directory
            $ticketData['image'] = $this->file_upload($request->file('image'), 'admin/ticket-image/');
        }
        $ticket = Ticket::create($ticketData);


        $message = array('message'=>'Successful ticket Send','alert-type'=>'success' );
        return redirect()->back()->with($message);




    }


    public function showTicket($id){
        $ticket = Ticket::findOrFail($id);
        $reply = Reply::where('ticket_id',$ticket->id)->orderBy('id','DESC')->get();
        return view('website.user.show-ticket',compact('ticket','reply'));
    }


    public function replyStore(Request $request){
        $request->validate([
            'message'=>'required'
        ]);

        $ticketData = [
            'user_id' => Auth::id(),
            'ticket_id' => $request->ticket_id,
            'message' => $request->message,
            'reply_date'  => date('Y-m-d'),
        ];

        if ($request->hasFile('image')) {
            // Store the uploaded image in the appropriate directory
            $ticketData['image'] = $this->file_upload($request->file('image'), 'admin/ticket-image/');
        }
        $ticket = Reply::create($ticketData);

        Ticket::where('id',$request->ticket_id)->update(['status'=>0]);
        $message = array('message'=>'Replied Done','alert-type'=>'success' );
        return redirect()->back()->with($message);
    }


}
