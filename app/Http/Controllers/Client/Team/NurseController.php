<?php

namespace App\Http\Controllers\Client\Team;

use App\Http\Controllers\Controller;
use App\Models\Nurse;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    public function index(Request $request)
    {
        $meta_desc = "As a nurse, my experience with vaccines has been very rewarding. Vaccines are a powerful tool for preventing the spread of infectious diseases and keeping individuals and communities healthy. Throughout my career, I have administered countless vaccinations, from routine childhood immunizations to flu shots for adults. It is always gratifying to see the relief on a patient's face when they receive a vaccine and know they are protected from a serious illness.";
        $meta_keywords = "Experience of Nurse";
        //$meta_title = "Nurse ";
        $url_canonical = $request->url();
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $nurseClientList = Nurse::orderBy('updated_at', 'desc')->paginate(config('myconfig.item_per_page'));
        }else{
            $nurseClientList = Nurse::where('name', 'like', '%'.$keyword.'%')->paginate(config('myconfig.item_per_page'));
        }
        return view('client.pages.team.nurse_list',compact('nurseClientList','meta_desc', 'meta_keywords', 'url_canonical'));
    }

    public function show(string $slug, Request $request)
    {
        $meta_desc = "As a nurse, my experience with vaccines has been very rewarding. Vaccines are a powerful tool for preventing the spread of infectious diseases and keeping individuals and communities healthy. Throughout my career, I have administered countless vaccinations, from routine childhood immunizations to flu shots for adults. It is always gratifying to see the relief on a patient's face when they receive a vaccine and know they are protected from a serious illness.";
        $meta_keywords = "Experience of Nurse";
        //$meta_title = "Nurse ";
        $url_canonical = $request->url();
        $nurseClientList = Nurse::where('slug', $slug)->paginate(config('myconfig.item_per_page'));
        return view('client.pages.team.nurse_detail', compact('nurseClientList', 'meta_desc', 'meta_keywords', 'url_canonical'));
    }
}
