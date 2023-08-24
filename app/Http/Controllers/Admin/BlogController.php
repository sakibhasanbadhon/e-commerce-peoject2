<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Blog_category;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.blog.category.index');
    }


    public function getData(Request $request)
     {
         if ($request->ajax()) {
             $getData = Blog_category::latest('id');
             // dd($getData);

             return DataTables::eloquent($getData)
             ->addIndexColumn()
             ->addColumn('operation', function($category){
                 $operation = '
                     <button data-id="'.$category->id.'" id="edit-btn" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i></button>
                     <button data-id="'.$category->id.'" id="delete-btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                 ';

                 return $operation;
             })


             ->addColumn('date', function($category){
                 return $category->created_at->format('d-m-Y');
             })

             ->rawColumns(['operation','date'])
             ->make(true);


         }
     }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $coupon = Blog_category::updateOrCreate([
            'id' => $request->dataId
        ],
        [
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
        ]);

        if ($coupon) {
            $output=['status'=>'success','message'=>'Coupon added success'];
        }else {
            $output=['status'=>'error','message'=>'OPPS! Coupon not added'];

        }


        return response()->json($output);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $category = Blog_category::findOrFail($request->data_id);
            // dd($category);
        }
        return response()->json($category);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->data_id);
            $campaign_id = Blog_category::findOrFail($request->data_id);
        }

        $campaign_id->delete();
        $message = ['status'=>'success','message'=>'Blog Category has been Delete'];

        return response()->json($message);
    }




    // ----------------------------- blog post ------------------------------------

    public function blogIndex() {
        return view('admin.blog.blog-post.index');
    }

    public function blogGetData(Request $request)
     {
         if ($request->ajax()) {
             $getData = Blog::latest('id');
             // dd($getData);

             return DataTables::eloquent($getData)
             ->addIndexColumn()
             ->addColumn('operation', function($blog){
                 $operation = '
                     <a href="'.route('admin.blog.post.edit',$blog->id).'" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i></a>
                     <button data-id="'.$blog->id.'" id="delete-btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                 ';

                 return $operation;
             })

            ->addColumn('thumbnail', function($blog) {
                $image = '<img width="60" height="40" src="' . ($blog->thumbnail != null ? asset('admin/blog/'.$blog->thumbnail) : 'https://via.placeholder.com/80') . '">';
                return $image;
            })

            ->addColumn('date', function($blog){
                return $blog->created_at->format('d-m-Y');
            })

            ->addColumn('category', function($blog){
                return $blog->blogCategory->name;
            })

            ->addColumn('status', function($blog){
                if ($blog->status==1) {
                    return '<span class="badge badge-info"> Active </span>';
                } else {
                    return '<span class="badge badge-danger"> Inactive </span>';
                }
            
            })


             ->rawColumns(['operation','date','category','status','thumbnail'])
             ->make(true);


         }
     }


    public function blogCreate() {
        $blog_category= Blog_category::latest('id')->get();
        return view('admin.blog.blog-post.create',compact('blog_category'));

    }

    public function blogStore(Request $request) {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'tags'        => 'required',
            'thumbnail'   => 'required',
            'status'      => 'required',
        ]);

        $thumbnail_image = $this->file_upload($request->file('thumbnail'),'admin/blog/');


        $blog = Blog::create([
            'blog_category_id' => $request->category,
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'description'      => $request->description,
            'tag'              => $request->tags,
            'thumbnail'        => $thumbnail_image,
            'status'           => $request->status,
        ]);

        if ($blog) {
            $notification = array('message'=>'Blog Create Successfully !','alert-type' => 'success');
        }else {
            $notification = array('message'=>'Opps! Blog Create Fail !','alert-type' => 'success');
        }


        return redirect()->back()->with($notification);


    }



    public function blogEdit($id){
        $blog_category = Blog_category::get();
        $blogDetails = Blog::where('id',$id)->first();
        return view('admin.blog.blog-post.edit',compact('blog_category','blogDetails'));
        
    }



    public function blogUpdate(Request $request,$id) {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'tags'        => 'required',
            'status'      => 'required',
        ]);

        $blog_update = Blog::findOrFail($id);

        // $thumbnail_image = $this->file_upload($request->file('thumbnail'),'admin/blog/');
        if ($request->has('thumbnail')) {
            file_exists('admin/blog/'.$blog_update->thumbnail) ? unlink('admin/blog/'.$blog_update->thumbnail) : false;
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $imageName = uniqid(rand().time()).'.'.$extension;
            $file->move('admin/blog/',$imageName);
        }else{
            $imageName = $blog_update->thumbnail;
        }


        $blog = $blog_update->update([
            'blog_category_id' => $request->category,
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'description'      => $request->description,
            'tag'              => $request->tags,
            'thumbnail'        => $imageName,
            'status'           => $request->status,
        ]);

        if ($blog) {
            $notification = array('message'=>'Blog Update Successfully !','alert-type' => 'success');
        }else {
            $notification = array('message'=>'Opps! Blog update Fail !','alert-type' => 'error');
        }

        return redirect()->back()->with($notification);

    }



    public function blogDestroy(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->data_id);
            $blog_id = Blog::findOrFail($request->data_id);
            unlink('admin/blog/'.$blog_id->thumbnail);
        }

        $blog_id->delete();
        $message = ['status'=>'success','message'=>'Blog has been Delete'];

        return response()->json($message);
    }


}
