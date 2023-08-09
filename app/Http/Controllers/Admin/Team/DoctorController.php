<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctor\StoreDoctorRequest;
use App\Http\Requests\Admin\Doctor\UpdateDoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $doctorList = Doctor::withTrashed()->orderBy('updated_at', 'desc')->paginate(config('myconfig.item_per_page'));
        }else{
            $doctorList = Doctor::withTrashed()->where('name', 'like', '%'.$keyword.'%')->paginate(config('myconfig.item_per_page'));
        }
        return view('admin.pages.team.list_doctor',compact('doctorList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.team.create_doctor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        try{
            DB::beginTransaction();
            if($request->hasFile('image_url')){ // kiểm tra xem có file up lên ko
                $originName= $request->file('image_url')->getClientOriginalName();//lấy tên cũ của ảnh
                $fileName= pathinfo($originName, PATHINFO_FILENAME); // gắn thêm đường dẫn
                $extension = $request->file('image_url')->getClientOriginalExtension();// .jpg
                $fileName = $fileName.'_'.time().'.'.$extension; // thêm time để nó là unique
                $request->file('image_url')->move(public_path('images/admin/doctor'), $fileName); // di chuyển đến folder
            }

            $check = Doctor::create([
                'name'=> $request->name,
                'slug'=> $request->slug,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'dob'=> $request->dob,
                'position'=> $request->position,
                'short_information'=> $request->short_information,
                'information'=> $request->information,
                'image_url'=> $fileName
            ]);
            DB::commit();
            $msg = $check ? 'success' : "failed";
            return redirect()->route('admin.doctor.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctorList = DB::select('select * from doctor where id= ?', [$id]);
        return view('admin.pages.team.detail_doctor', compact('doctorList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        try{
            DB::beginTransaction();
            $fileName = $doctor->image_url; // nếu không có ảnh update
            if($request->hasFile('image_url')){ // kiểm tra xem có file up lên ko
                $originName= $request->file('image_url')->getClientOriginalName();//lấy tên cũ của ảnh
                $fileName= pathinfo($originName, PATHINFO_FILENAME); // gắn thêm đường dẫn
                $extension = $request->file('image_url')->getClientOriginalExtension();// .jpg
                $fileName = $fileName.'_'.time().'.'.$extension; // thêm time để nó là unique
                $request->file('image_url')->move(public_path('images/admin/doctor'), $fileName); // di chuyển đến folder

                if(!is_null($doctor->image_url)&& file_exists("images/admin/doctor/".$doctor->image_url)){
                    unlink("images/admin/doctor/".$doctor->image_url);
                }
            }

            $check = $doctor->update([
                'name'=>$request->name,
                'slug'=> $request->slug,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'dob'=>$request->dob,
                'position'=>$request->position,
                'short_information'=>$request->short_information,
                'information'=>$request->information,
                'image_url'=>$fileName
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.doctor.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        // if(!is_null($doctor->image_url)&& file_exists("images/admin/doctor/".$doctor->image_url)){
        //     unlink("images/admin/doctor/".$doctor->image_url);
        // } // không xóa hình vì xóa mềm
        $check = $doctor->delete();
        $msg = $check ? 'success' : 'failed';
        return redirect()->route('admin.doctor.index')->with('message', $msg);
    }
    public function restore(string $doctor)
    {
        $doctor = Doctor::withTrashed()->find($doctor);
        $doctor->restore();
        return redirect()->route('admin.doctor.index');
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

            $request->file('upload')->move(public_path('images/admin/doctor/'), $fileName);

            $url = asset('images/admin/doctor/' . $fileName);
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
