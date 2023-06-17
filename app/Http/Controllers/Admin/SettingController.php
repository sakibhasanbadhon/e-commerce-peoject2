<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function seo() {
        $seoData = Seo::first();
        // dd($seo);
        return view('admin.setting.seo',['seoData'=> $seoData]);

    }

    public function seoUpdate(Request $request, $id) {
        $data = $request->except('_token');
        Seo::create($data);

        $message = array('message'=>'Seo UPdate Success','alert-type'=>'success' );
        return redirect()->back()->with($message);
    }

}
