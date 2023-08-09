<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\StoreBlogRequest;
use App\Http\Requests\Admin\Blog\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        $filter =[];
        if(!is_null( $keyword )){
            $filter[]=['name', 'like','%'.$keyword.'%'];
        }
        if(!is_null( $status )){
            $filter[]=['status', $status];
        }
        $blogList = Blog::where($filter)->orderBy('updated_at', 'desc')->paginate(config('myconfig.item_per_page'));
        return view('admin.pages.blog.list_blog',compact('blogList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.blog.create_blog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        try{
            DB::beginTransaction();
            if($request->hasFile('image_url')){ // kiểm tra xem có file up lên ko
                $originName= $request->file('image_url')->getClientOriginalName();//lấy tên cũ của ảnh
                $fileName= pathinfo($originName, PATHINFO_FILENAME); // gắn thêm đường dẫn
                $extension = $request->file('image_url')->getClientOriginalExtension();// .jpg
                $fileName = $fileName.'_'.time().'.'.$extension; // thêm time để nó là unique
                $request->file('image_url')->move(public_path('images/admin/blog'), $fileName); // di chuyển đến folder
            }

            $check = Blog::create([
                'name'=> $request->name,
                'slug'=> $request->slug,
                'short_description'=> $request->short_description,
                'description'=> $request->description,
                'image_url'=> $fileName,
                'status'=> $request->status
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.blog.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blogList = DB::select('select * from blog where id= ?', [$id]);
        return view('admin.pages.blog.detail_blog', compact('blogList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        try{
            DB::beginTransaction();
            $fileName = $blog->image_url; // nếu không có ảnh update
            if($request->hasFile('image_url')){ // kiểm tra xem có file up lên ko
                $originName= $request->file('image_url')->getClientOriginalName();//lấy tên cũ của ảnh
                $fileName= pathinfo($originName, PATHINFO_FILENAME); // gắn thêm đường dẫn
                $extension = $request->file('image_url')->getClientOriginalExtension();// .jpg
                $fileName = $fileName.'_'.time().'.'.$extension; // thêm time để nó là unique
                $request->file('image_url')->move(public_path('images/admin/blog'), $fileName); // di chuyển đến folder

                //remove old images
                if(!is_null($blog->image_url)&& file_exists("images/admin/blog/".$blog->image_url)){
                    unlink("images/admin/blog/".$blog->image_url);
                }
            }
            $check = $blog->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'short_description'=>$request->short_description,
                'description'=>$request->description,
                'image_url'=>$fileName,
                'status'=>$request->status
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.blog.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //remove images
        if(!is_null($blog->image_url)&& file_exists("images/admin/blog/".$blog->image_url)){
            unlink("images/admin/blog/".$blog->image_url);
        }
        $check = $blog->delete();
        $msg = $check ? 'success' : 'failed';
        return redirect()->route('admin.blog.index')->with('message', $msg);
    }

    public function getSlug(Request $request)
    {
        $slug = Str::slug($request->name) ;
        return response()->json(['slug'=>$slug]);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images/admin/blog/'), $fileName);

            $url = asset('images/admin/blog/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
}
