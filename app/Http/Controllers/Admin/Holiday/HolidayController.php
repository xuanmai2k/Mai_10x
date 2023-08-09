<?php

namespace App\Http\Controllers\Admin\Holiday;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Holiday\StoreHolidayRequest;
use App\Http\Requests\Admin\Holiday\UpdateHolidayRequest;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $holidayList = Holiday::orderBy('dayoff', 'asc')->paginate(config('myconfig.item_per_page'));
        }else{
            $holidayList = Holiday::where('name_of_date', 'like', '%'.$keyword.'%')->orderBy('dayoff', 'asc')->paginate(config('myconfig.item_per_page'));
        }
        return view('admin.pages.holiday.list_holiday',compact('holidayList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.holiday.create_holiday');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHolidayRequest $request)
    {
        try{
            DB::beginTransaction();
            $check = Holiday::create([
                'name_of_date'=> $request->name_of_date,
                'dayoff'=> $request->dayoff
            ]);
            DB::commit();
            $msg = $check ? 'success' : "failed";
            return redirect()->route('admin.holiday.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $holidayList = DB::select('select * from holiday where id= ?', [$id]);
        return view('admin.pages.holiday.detail_holiday', compact('holidayList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHolidayRequest $request, Holiday $holiday)
    {
        try{
            DB::beginTransaction();
            $check = $holiday->update([
                'name_of_date'=>$request->name_of_date,
                'dayoff'=>$request->dayoff
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.holiday.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        $check = $holiday->delete();
        $msg = $check ? 'success' : 'failed';
        return redirect()->route('admin.holiday.index')->with('message', $msg);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
}
