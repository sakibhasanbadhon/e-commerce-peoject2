<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\Setting;
use App\Models\Payment_gateway;
use App\Models\SmtpMail;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp\Smaller;

class SettingController extends Controller
{
    public function seo() {
        $seoData = Seo::first();
        // dd($seo);
        return view('admin.setting.seo',['seoData'=> $seoData]);

    }

    // seo update
    public function seoUpdate(Request $request, $id)
    {
        $seoData = Seo::find($id);

        if ($seoData) {
            $seoData->update($request->except('_token'));
            $message = array('message' => 'Seo Update Success', 'alert-type' => 'success');
        } else {
            $message = array('message' => 'Data Not update', 'alert-type' => 'error');
        }

        return redirect()->back()->with($message);
    }



    // smtp page show
    public function smtp() {
        $smtp = SmtpMail::first();
        // dd($smtp);
        return view('admin.setting.smtp',['smtp'=> $smtp]);
    }


    // seo update
    public function smtpUpdate(Request $request, $id)
    {
        $smtpData = SmtpMail::find($id);
        if ($smtpData) {
            $smtpData->update($request->except('_token'));
            $message = array('message' => 'SMTP Update Success', 'alert-type' => 'success');
        } else {
            $message = array('message' => 'Data Not Update', 'alert-type' => 'error');
        }

        return redirect()->back()->with($message);
    }


    // website setting page show
    public function website() {
        $websiteSettings = Setting::first();
        // dd($smtp);
        return view('admin.setting.website_setting',['websiteSettings'=> $websiteSettings]);
    }

    // website setting update
    public function websiteUpdate(Request $request, $id) {

        $websiteSettings = Setting::findOrFail($id);

            if($request->hasFile('logo')){
                $logo = $this->file_update($request->file('logo'),'admin/logo-favicon/',$websiteSettings->logo);
            }else{
                $logo = $websiteSettings->logo;
            }

            if($request->hasFile('favicon')){
                $favicon = $this->file_update($request->file('favicon'),'admin/logo-favicon/',$websiteSettings->favicon);
            }else{
                $favicon = $websiteSettings->favicon;
            }

            $data = $websiteSettings->update([
                'currency'     => $request->currency,
                'phone_one'    => $request->phone_one,
                'phone_two'    => $request->phone_two,
                'main_email'   => $request->main_email,
                'support_mail' => $request->support_mail,
                'logo'         => $logo,
                'favicon'      => $favicon,
                'address'      => $request->address,
                'facebook'     => $request->facebook,
                'twitter'      => $request->twitter,
                'linkedin'     => $request->linkedin,
                'youtube'      => $request->youtube
            ]);
            if ($data) {
                $message = array('message'=>'Data Update Success','alert-type'=>'success' );
            }else {
                $message = array('message'=>'Data Not Update','alert-type'=>'error' );
            }

            return redirect()->back()->with($message);


    }



    public function paymentGateway(){
        $amarpay = Payment_gateway::first();
        $surjopay = Payment_gateway::skip(1)->first();
        $ssl = Payment_gateway::skip(2)->first();

        return view('admin.payment_gateway.edit',compact('amarpay','surjopay','ssl'));

    }

    public function amarpayUpdate(Request $request){

        $amarpay = Payment_gateway::findOrFail($request->id);
        $amarpay = $amarpay->update([
            'store_id'      => $request->store_id,
            'signature_key' => $request->signature_key,
            'status'        => $request->status
        ]);

        $message = array('message'=>'Amarpay Payment gateway updated','alert-type'=>'success' );
        return redirect()->back()->with($message);

    }

    public function surjopayUpdate(Request $request){

        $surjopay = Payment_gateway::findOrFail($request->id);
        $surjopay->update([
            'store_id'      => $request->store_id,
            'signature_key' => $request->signature_key,
            'status'        => $request->status
        ]);

        $message = array('message'=>'Surjopay Payment gateway updated','alert-type'=>'success');
        return redirect()->back()->with($message);

    }


}
