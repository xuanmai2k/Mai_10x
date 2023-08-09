<?php

namespace App\Http\Controllers\Client\Team;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $meta_desc = "As a doctor, I have extensive experience with vaccines and their benefits. Vaccines are one of the most effective tools we have for preventing the spread of infectious diseases and keeping our communities healthy. Throughout my career, I have seen firsthand the positive impact that vaccines can have in protecting individuals from diseases";
        $meta_keywords = "Experience of Doctor";
        //$meta_title = "Doctor ";
        $url_canonical = $request->url();
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $doctorClientList = Doctor::orderBy('updated_at', 'desc')->paginate(config('myconfig.item_per_page'));
        }else{
            $doctorClientList = Doctor::where('name', 'like', '%'.$keyword.'%')->paginate(config('myconfig.item_per_page'));
        }
        return view('client.pages.team.doctor_list',compact('doctorClientList', 'meta_desc', 'meta_keywords', 'url_canonical'));
    }

    public function show(string $slug, Request $request)
    {
        $meta_desc = "As a doctor, I have extensive experience with vaccines and their benefits. Vaccines are one of the most effective tools we have for preventing the spread of infectious diseases and keeping our communities healthy. Throughout my career, I have seen firsthand the positive impact that vaccines can have in protecting individuals from diseases";
        $meta_keywords = "Experience of Doctor";
        //$meta_title = "Doctor ";
        $url_canonical = $request->url();
        $doctorClientList = Doctor::where('slug', $slug)->paginate(config('myconfig.item_per_page'));
        return view('client.pages.team.doctor_detail', compact('doctorClientList', 'meta_desc', 'meta_keywords', 'url_canonical'));
    }
}
