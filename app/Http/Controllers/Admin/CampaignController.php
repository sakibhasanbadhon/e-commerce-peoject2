<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Yajra\DataTables\Facades\DataTables;

class CampaignController extends Controller
{

    public function index()
    {
        return view('admin.campaign.index');
    }

    /**
     * brand get Data
     */

     public function getData(Request $request)
     {
         if ($request->ajax()) {
             $getData = Campaign::latest('id');
             // dd($getData);

             return DataTables::eloquent($getData)
             ->addIndexColumn()
             ->addColumn('operation', function($campaign){
                 $operation = '
                     <button data-id="'.$campaign->id.'" id="edit-btn" class="btn btn-success btn-sm">Edit</button>
                     <button data-id="'.$campaign->id.'" id="delete-btn" class="btn btn-danger btn-sm">Delete</button>
                 ';

                 return $operation;
             })

             ->addColumn('campaign_image', function($campaign) {
                $image = '<img width="100" height="30" src="' . ($campaign->image != null ? asset('admin/campaign-img/'.$campaign->image) : 'https://via.placeholder.com/80') . '">';
                return $image;
            })

            //  ->addColumn('created_at', function($campaign){
            //      return $campaign->created_at->format('d-m-Y');
            //  })

             ->rawColumns(['operation','campaign_image'])
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
        $image = $this->file_upload($request->file('image'),'admin/campaign-img/');

        $campaign = Campaign::create([
            'title'      => $request->title,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'status'     => $request->status,
            'discount'   => $request->discount,
            'image'      => $image,
            'month'      => date('F'),
            'year'       => date('Y'),
        ]);


        if ($campaign) {
            $output=['status'=>'success','message'=>'Data has been Updated success'];
        }else {
            $output=['status'=>'error','message'=>'Something went wrong'];

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
            $campaign = Campaign::findOrFail($request->data_id);

            $status = '
                <select class="form-control" name="status" required>
                    <option value="1" ' . ($campaign->status == 1 ? 'selected' : '') . '>Active</option>
                    <option value="0" ' . ($campaign->status == 0 ? 'selected' : '') . '>Inactive</option>
                </select>
            ';

            return response()->json([
                'campaign'=>$campaign,
                'campaign_status'  => $status
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if($request->ajax()){
            $campaign_update = Campaign::findOrFail($request->dataId);

            if($request->hasFile('image')){
                $image = $this->file_update($request->file('image'),'admin/campaign-img/',$campaign_update->image);
            }else{
                $image = $campaign_update->image;
            }

            $data = $campaign_update->update([
                'title'      => $request->title,
                'start_date' => $request->start_date,
                'end_date'   => $request->end_date,
                'status'     => $request->status,
                'discount'   => $request->discount,
                'image'      => $image,
            ]);

            if ($data) {
                $output=['status'=>'success','message'=>'Data has been Updated success'];
            }else{
                $output=['status'=>'error','message'=>'Something error'];
            }

            return response()->json($output);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->data_id);

            $campaign_id = Campaign::find($request->data_id);
            unlink('admin/campaign-img/'.$campaign_id->image);
        }

        $campaign_id->delete();

        $message = ['status'=>'success','message'=>'Data has been Delete'];

        return response()->json($message);
    }

}
