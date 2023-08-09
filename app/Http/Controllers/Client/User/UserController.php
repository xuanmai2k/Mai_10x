<?php

namespace App\Http\Controllers\Client\User;

use App\Events\AppointmentCancelEvent;
use App\Events\AppointmentCompleteEvent;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $url_canonical = $request->url();
        $keyword = $request->keyword;
        $status = $request->status;
        $id = auth()->id();
        if(!is_null( $keyword )){
            $filter[]=['name', 'like','%'.$keyword.'%'];
        }
        if(!is_null( $status )){
            $filter[]=['status', $status];
        }
        if(!is_null( $id )){
            $filter[]=['users_id', $id];
        }
        $bookingList = Appointment::where($filter)->orderBy('date_appointment','desc')->paginate(config('myconfig.item_per_page'));
        return view('client.pages.user.account', compact('bookingList','url_canonical'));
    }

    public function changeStatusComplete(string $id)
    {
        try{
            DB::beginTransaction();
            $appointment = Appointment::find($id);
            if($appointment->date_appointment <= now()){
                $check = event(new AppointmentCompleteEvent($appointment));
                $msg = 'success';
            }else{
                $msg = 'failed';
            }
            DB::commit();
            // $msg = $check ? 'success' : 'failed';
            return redirect()->route('account.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    public function changeStatusCancel(string $id)
    {
        try{
            DB::beginTransaction();
            $appointment = Appointment::find($id);
            $check = event(new AppointmentCancelEvent($appointment));
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('account.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    public function evaluate(Request $request) //đánh giá
    {
        try{
            DB::beginTransaction();
            $check = Appointment::where('id',$request->booking_id)->update([
                'rating' => $request->rating,
                'comment' => $request->comment
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('client.account.history', ['id' => $request->booking_id])->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    public function history(string $id){
        $bookingList = Appointment::where('id', $id)->get();
        return view('client.pages.user.history_detail', compact('bookingList'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
