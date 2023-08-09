<?php

namespace App\Http\Controllers\Admin\ProductCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategory\StoreProductCategoryRequest;
use App\Http\Requests\Admin\ProductCategory\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
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
        $productCategoryList = ProductCategory::withTrashed()->where($filter)->orderBy('created_at', 'desc')->paginate(config('myconfig.item_per_page'));
        return view('admin.pages.product_category.list_product_category',compact('productCategoryList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.product_category.create_product_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        try{
            DB::beginTransaction();
            $check = ProductCategory::create([
                'name'=> $request->name,
                'slug'=> $request->slug,
                'minimum_limit_age' =>$request->minimum_limit_age,
                'maximum_limit_age'=> $request->maximum_limit_age,
                'quantity_for_injection'=>$request->quantity_for_injection,
                'status'=> $request->status
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.product-category.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productCategoryList = DB::select('select * from product_category where id= ?', [$id]);
        return view('admin.pages.product_category.detail_product_category', compact('productCategoryList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        try{
            DB::beginTransaction();
            $check = $productCategory->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'minimum_limit_age' =>$request->minimum_limit_age,
                'maximum_limit_age'=> $request->maximum_limit_age,
                'quantity_for_injection'=>$request->quantity_for_injection,
                'status'=>$request->status
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.product-category.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $check = $productCategory->delete();
        $msg = $check ? 'success' : 'failed';
        return redirect()->route('admin.product-category.index')->with('message', $msg);
    }

    public function restore(string $productCategory)
    {
        $productCategory = ProductCategory::withTrashed()->find($productCategory);
        $productCategory->restore();
        return redirect()->route('admin.product-category.index');
    }

    public function getSlug(Request $request)
    {
        $slug = Str::slug($request->name) ;
        return response()->json(['slug'=> $slug ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
}
