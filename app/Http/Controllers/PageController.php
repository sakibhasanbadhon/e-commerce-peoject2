<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * page index show
     */
    public function index(){
        $pages = DB::table('pages')->get();
        return view('admin.page.index',['pages'=>$pages]);
    }



    /**
     * create page show korar jonno
    */

    public function create(){
        return view('admin.page.create');
    }




/**
 * page store Data
 */
    public function store(Request $request){

        $request->validate([
            'page_position'    => 'required',
            'page_name'        => 'required',
            'page_title'       => 'required',
            'page_description' => 'required'
        ]);

        $data = $request->except('_token');
        $data['page_slug']= Str::slug($request->page_name);

        Page::create($data);

        $message = array('message'=>'Page Create Success','alert-type'=>'success' );
        return redirect()->back()->with($message);


    }





    /**
     * page edit data
     */
    public function edit($id){
        $pages = Page::findOrFail($id);
        return view('admin.page.edit',['pages'=>$pages]);
    }

    /**
     * page update data
     */
    public function update(Request $request, $id){
        $request->validate([
            'page_position'    => 'required',
            'page_name'        => 'required',
            'page_title'       => 'required',
            'page_description' => 'required'
        ]);

        $data = Page::findOrFail($id);

        $data->update([
            'page_position'    => $request->page_position,
            'page_name'        => $request->page_name,
            'page_slug'        => Str::slug($request->page_name),
            'page_title'       => $request->page_title,
            'page_description' => $request->page_description,

        ]);

        if ($data) {
            $notification = array('message'=>'Page Update Success.','alert-type' => 'success');
        }else {
            $notification = array('message'=>'OPPS ! Not Update !','alert-type' => 'error');

        }

        return redirect()->back()->with($notification);


    }



    // delete

    public function destroy($id){
        $delete_row = Page::findOrFail($id);
        $delete_row->delete();

        if ($delete_row) {
            $notification = array('message'=>'Delete Success.','alert-type' => 'success');
        }else {
            $notification = array('message'=>'OPPS ! Not Delete !','alert-type' => 'error');

        }

        return redirect()->back()->with($notification);
    }


}
