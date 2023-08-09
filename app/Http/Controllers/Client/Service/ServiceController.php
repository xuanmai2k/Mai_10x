<?php

namespace App\Http\Controllers\Client\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        //seo
        $meta_desc = "Service pages related to vaccines offer a range of resources to support individuals in getting vaccinated. These pages may offer details about the types of vaccines available, as well as guidance on how to schedule appointments or find vaccination sites near you. They may also provide information about the safety and effectiveness of vaccines, as well as tips for managing any side effects that may occur after vaccination.";
        $meta_keywords = "Service about vaccine, service vaccination ";
        //$meta_title = "Service ";
        $url_canonical = $request->url();
        $keyword = $request->keyword;
        $sort = $request->sort;
        $amount_start = $request->amount_start;
        $amount_end = $request->amount_end;
        $filter = [];
        $filter[]=['status',1];
        if(!is_null( $keyword )){
            $filter[]=['name', 'like', '%'.$keyword.'%'];
        }
        if(!is_null( $amount_start ) && !is_null( $amount_end )){
            $filter[]=['price', '>=', $amount_start];
            $filter[]=['price', '<=', $amount_end];
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
        $serviceClientList = Service::where($filter)->orderBy($sortBy[0], $sortBy[1])->paginate(config('myconfig.item_per_page'));
        $maxPrice = Service::where('status', 1)->max('price');
        $minPrice = Service::where('status', 1)->min('price');
        return view('client.pages.service.service_list', compact('serviceClientList', 'meta_desc', 'meta_keywords','url_canonical', 'minPrice', 'maxPrice'));
    }

    public function show(string $slug, Request $request)
    {
        //seo
        $meta_desc = "Service pages related to vaccines offer a range of resources to support individuals in getting vaccinated. These pages may offer details about the types of vaccines available, as well as guidance on how to schedule appointments or find vaccination sites near you. They may also provide information about the safety and effectiveness of vaccines, as well as tips for managing any side effects that may occur after vaccination.";
        $meta_keywords = "Service about vaccine, service vaccination ";
        //$meta_title = "Service ";
        $url_canonical = $request->url();
        $serviceClientList = Service::where('slug', $slug)->paginate(config('myconfig.item_per_page'));
        return view('client.pages.service.service_detail', compact('serviceClientList','meta_desc', 'meta_keywords','url_canonical'));
    }
}
