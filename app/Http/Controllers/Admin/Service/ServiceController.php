<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        $sort = $request->sort;
        $filter =[];
        if(!is_null( $keyword )){
            $filter[]=['name', 'like','%'.$keyword.'%'];
        }
        if(!is_null( $status )){
            $filter[]=['status', $status];
        }
        $sortBy = ['id','desc'];
        switch($sort){
            case 1:
                $sortBy = ['price', 'asc'];
                break;
            case 2:
                $sortBy = ['price', 'desc'];
                break;
        }
        $serviceList = Service::where($filter)->orderBy($sortBy[0], $sortBy[1])->paginate(config('myconfig.item_per_page'));
        return view('admin.pages.service.list_service',compact('serviceList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.service.create_service');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        try{
            DB::beginTransaction();
            if($request->hasFile('image_url')){ // kiểm tra xem có file up lên ko
                $originName= $request->file('image_url')->getClientOriginalName();//lấy tên cũ của ảnh
                $fileName= pathinfo($originName, PATHINFO_FILENAME); // gắn thêm đường dẫn
                $extension = $request->file('image_url')->getClientOriginalExtension();// .jpg
                $fileName = $fileName.'_'.time().'.'.$extension; // thêm time để nó là unique
                $request->file('image_url')->move(public_path('images/admin/service'), $fileName); // di chuyển đến folder
            }

            $check = Service::create([
                'name'=> $request->name,
                'slug'=> $request->slug,
                'price'=> $request->price,
                'short_description'=> $request->short_description,
                'description'=> $request->description,
                'image_url'=> $fileName,
                'status'=> $request->status
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.service.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceList = DB::select('select * from service where id= ?', [$id]);
        return view('admin.pages.service.detail_service', compact('serviceList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        try{
            DB::beginTransaction();
            $fileName = $service->image_url; // nếu không có ảnh update
            if($request->hasFile('image_url')){ // kiểm tra xem có file up lên ko
                $originName= $request->file('image_url')->getClientOriginalName();//lấy tên cũ của ảnh
                $fileName= pathinfo($originName, PATHINFO_FILENAME); // gắn thêm đường dẫn
                $extension = $request->file('image_url')->getClientOriginalExtension();// .jpg
                $fileName = $fileName.'_'.time().'.'.$extension; // thêm time để nó là unique
                $request->file('image_url')->move(public_path('images/admin/service'), $fileName); // di chuyển đến folder

                //remove old images
                if(!is_null($service->image_url)&& file_exists("images/admin/service/".$service->image_url)){
                    unlink("images/admin/service/".$service->image_url);
                }
            }

            $check = $service->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'price'=>$request->price,
                'short_description'=>$request->short_description,
                'description'=>$request->description,
                'image_url'=>$fileName,
                'status'=>$request->status
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.service.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if(!is_null($service->image_url)&& file_exists("images/admin/service/".$service->image_url)){
            unlink("images/admin/service/".$service->image_url);
        }
        $check = $service->delete();
        $msg = $check ? 'success' : 'failed';
        return redirect()->route('admin.service.index')->with('message', $msg);
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

            $request->file('upload')->move(public_path('images/admin/service/'), $fileName);

            $url = asset('images/admin/service/' . $fileName);
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
