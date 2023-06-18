<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
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
    public function seoUpdate(Request $request, $id) {
        $data = $request->except('_token');
        Seo::create($data);

        $message = array('message'=>'Seo UPdate Success','alert-type'=>'success' );
        return redirect()->back()->with($message);
    }

    // smtp page show
    public function smtp() {
        $smtp = SmtpMail::first();
        // dd($smtp);
        return view('admin.setting.smtp',['smtp'=> $smtp]);
    }


    // seo update
    public function smtpUpdate(Request $request, $id) {
        $data = $request->except('_token');
        SmtpMail::create($data);

        $message = array('message'=>'Seo UPdate Success','alert-type'=>'success' );
        return redirect()->back()->with($message);
    }


}
