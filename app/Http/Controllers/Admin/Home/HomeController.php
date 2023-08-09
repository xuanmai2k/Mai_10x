<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $totalTodayBooking = Appointment::whereDate('created_at', $now)->count();

        //start chart
        //booking
        $totalBooking = Appointment::all()->count();
        $arrayDatas = [];
        $arrayDatas[] = ['status' ,'number'];
        $totalAppointment = Appointment::where('status',1)->count();
        $arrayDatas[] = ['Appointment' , $totalAppointment];
        $totalCompleteBooking = Appointment::where('status',2)->count();
        $arrayDatas[] = ['Complete' , $totalCompleteBooking];
        $totalCancelBooking = Appointment::where('status',3)->count();
        $arrayDatas[] = ['Cancel' , $totalCancelBooking];
        //rating
        $dataUserRating = DB::table('appointment')->selectRaw('rating, count(rating) as number')->groupBy('rating')->get();
        $arrayRating = [];
        $arrayRating[] = ['rating' ,'number'];
        foreach($dataUserRating as $data){
            $arrayRating[] = [(string)$data->rating." star", $data->number];
        }
        //end chart

        $totalUsers = User::all()->count();
        $totalVaccine = Product::all()->count();
        $totalContact = Contact::all()->count();
        //top
        $topDoctor = DB::table('doctor')
                ->join('appointment', 'doctor.id', '=', 'appointment.doctor_id')
                ->select('doctor.id', 'doctor.name', 'doctor.position','doctor.image_url', DB::raw('COUNT(appointment.doctor_id) as number'))
                ->groupBy('doctor.id', 'doctor.name', 'doctor.position', 'doctor.image_url')
                ->orderByDesc('number')
                ->take(5)
                ->get();
        $topVaccine = DB::table('product')
                ->join('appointment', 'product.id', '=', 'appointment.product_id')
                ->select('product.id', 'product.name_product', 'product.price', 'product.image_url', DB::raw('COUNT(appointment.product_id) as number'))
                ->groupBy('product.id', 'product.name_product', 'product.price', 'product.image_url')
                ->orderByDesc('number')
                ->take(5)
                ->get();
        //end top
        $vaccineEmpty = Product::where('status',1)->orderBy('qty', 'asc')->take(5)->get();
        //rating under 2 star
        $filter = [];
        $filter[] = ['status', 2];
        $filter[] = ['rating','<=', 2];
        $complainList = Appointment::where($filter)->orderBy('updated_at', 'desc')->take(5)->get();

        return view('admin/pages/home/home',
        compact('now','totalBooking','totalCompleteBooking', 'totalCancelBooking','totalTodayBooking','totalUsers','totalVaccine','totalContact', 'topDoctor', 'topVaccine', 'vaccineEmpty', 'complainList', 'totalAppointment', 'arrayDatas','arrayRating'));
    }
}
