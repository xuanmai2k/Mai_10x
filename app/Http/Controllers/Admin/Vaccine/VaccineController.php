<?php

namespace App\Http\Controllers\Admin\Vaccine;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Vaccine\StoreProductRequest;
use App\Http\Requests\Admin\Vaccine\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VaccineController extends Controller
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
            $filter[]=['name_product', 'like','%'.$keyword.'%'];
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
        $vaccineList = Product::withTrashed()->where($filter)->orderBy($sortBy[0], $sortBy[1])->paginate(config('myconfig.item_per_page'));
        return view('admin.pages.vaccine.list_vaccine', ['vaccineList' => $vaccineList]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategoryList = DB::select('select * from product_category');
        return view('admin.pages.vaccine.create_vaccine')->with('productCategoryList',$productCategoryList);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try{
            DB::beginTransaction();
            if($request->hasFile('image_url')){ // kiểm tra xem có file up lên ko
                $originName= $request->file('image_url')->getClientOriginalName();//lấy tên cũ của ảnh
                $fileName= pathinfo($originName, PATHINFO_FILENAME); // gắn thêm đường dẫn
                $extension = $request->file('image_url')->getClientOriginalExtension();// .jpg
                $fileName = $fileName.'_'.time().'.'.$extension; // thêm time để nó là unique
                $request->file('image_url')->move(public_path('images/admin/vaccine'), $fileName); // di chuyển đến folder
            }
            $check = Product::create([
                'name_product'=> $request->name_product,
                'slug'=> $request->slug,
                'price'=> $request->price,
                'made_in'=>$request->made_in,
                'short_description'=> $request->short_description,
                'description'=> $request->description,
                'information'=> $request->information,
                'product_category_id'=> $request->product_category_id,
                'dosage' => $request->dosage,
                'qty'=> $request->qty,
                'image_url'=>$fileName,
                'status'=> $request->status
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.vaccine.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) //detail
    {
        // $vaccineList = DB::select('select * from product where id= ?', [$id]);
        $vaccineList = Product::where('id', [$id])->get();
        $productCategoryList = ProductCategory::all();
        return view('admin.pages.vaccine.detail_vaccine',  ['vaccineList' => $vaccineList,'productCategoryList'=> $productCategoryList]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $vaccine)
    {
        try{
            DB::beginTransaction();
            $fileName= $vaccine->image_url; // nếu không có nhập mới thì lấy url cũ
            if($request->hasFile('image_url')){ // kiểm tra xem có file up lên ko
                $originName= $request->file('image_url')->getClientOriginalName();//lấy tên cũ của ảnh
                $fileName= pathinfo($originName, PATHINFO_FILENAME); // gắn thêm đường dẫn
                $extension = $request->file('image_url')->getClientOriginalExtension();// .jpg
                $fileName = $fileName.'_'.time().'.'.$extension; // thêm time để nó là unique
                $request->file('image_url')->move(public_path('images/admin/vaccine'), $fileName); // di chuyển đến folder
                //remove old images
                if(!is_null($vaccine->image_url)&& file_exists("images/admin/vaccine/".$vaccine->image_url)){
                    unlink("images/admin/vaccine/".$vaccine->image_url);
                }
            }
            $check = $vaccine->update([
                'name_product' =>  $request->name_product,
                'slug' =>  $request->slug,
                'price' =>  $request->price,
                'made_in'=>$request->made_in,
                'short_description' =>  $request->short_description,
                'description' =>  $request->description,
                'information' =>  $request->information,
                'product_category_id'=> $request->product_category_id,
                'dosage' => $request->dosage,
                'qty' =>  $request->qty,
                'image_url' => $fileName,
                'status' =>  $request->status,
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.vaccine.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $vaccine)
    {
        // if(!is_null($vaccine->image_url)&& file_exists("images/admin/vaccine/".$vaccine->image_url)){
        //     unlink("images/admin/vaccine/".$vaccine->image_url);
        // } // không xóa hình xóa mềm
        $check = $vaccine->delete();
        $msg = $check ? 'success' : 'failed';
        return redirect()->route('admin.vaccine.index')->with('message', $msg);
    }

    public function restore(string $vaccine)
    {
        $vaccine = Product::withTrashed()->find($vaccine);
        $vaccine->restore();
        return redirect()->route('admin.vaccine.index');
    }

    public function getSlug(Request $request)
    {
        $slug = Str::slug($request->name_product) ;
        return response()->json(['slug'=>$slug]);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images/admin/vaccine/'), $fileName);

            $url = asset('images/admin/vaccine/' . $fileName);
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
