<?php

namespace App\Http\Controllers\Admin\Appointment;

use App\Events\AppointmentCancelEvent;
use App\Events\AppointmentCompleteEvent;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $appointmentList = Appointment::where('status',1)->orderBy('date_appointment', 'asc')->orderBy('time_appointment', 'asc')->paginate(config('myconfig.item_per_page'));
        }else{
            $appointmentList = Appointment::where('status', 1)
                ->where(function ($query) use($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('phone', 'like', '%'.$keyword.'%')
                    ->orWhere('email', 'like', '%'.$keyword.'%');
                })
            ->orderBy('date_appointment', 'desc')
            ->orderBy('time_appointment', 'desc')
            ->paginate(config('myconfig.item_per_page'));
        }
        return view('admin.pages.appointment.list_appointment', compact('appointmentList'));
    }

    public function completeList(Request $request)
    {
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $appointmentList = Appointment::where('status',2)->paginate(config('myconfig.item_per_page'));
        }else{
            $appointmentList = Appointment::where('status', 2)
                ->where(function ($query) use($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('phone', 'like', '%'.$keyword.'%')
                    ->orWhere('email', 'like', '%'.$keyword.'%');
                })
            ->orderBy('updated_at', 'desc')
            ->paginate(config('myconfig.item_per_page'));
        }
        return view('admin/pages/appointment/used_appointment_list', compact('appointmentList'));
    }

    public function cancelList(Request $request)
    {
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $appointmentList = Appointment::where('status', 3)->orderBy('updated_at', 'desc')->paginate(config('myconfig.item_per_page'));
        }else{
            $appointmentList = Appointment::where('status', 3)
                ->where(function ($query) use($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('phone', 'like', '%'.$keyword.'%')
                    ->orWhere('email', 'like', '%'.$keyword.'%');
                })
            ->orderBy('updated_at', 'desc')
            ->paginate(config('myconfig.item_per_page'));
        }
        return view('admin/pages/appointment/canceled_appointment_list', compact('appointmentList'));
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
            return redirect()->route('admin.appointment.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    public function changeStatusCancel(string $id){
        try{
            DB::beginTransaction();
            $appointment = Appointment::find($id);
            $check = event(new AppointmentCancelEvent($appointment));
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.appointment.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        //
    }
    public function show(string $id){
        //
    }
    public function edit(string $id){
        //
    }
    public function update(Request $request, string $id){
        //
    }
    public function destroy(string $id){
        //
    }


}
