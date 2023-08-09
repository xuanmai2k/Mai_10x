<?php

namespace App\Http\Controllers\Client\Vaccine;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VaccineController extends Controller
{
    public function index(Request $request)
    {
        $meta_desc = "Vaccine is a biological substance that helps to stimulate an immune response in the body, providing protection against specific infectious diseases. It typically contains weakened or inactivated forms of the disease-causing agent, such as viruses or bacteria, or specific parts of those agents. When administered, vaccines trigger the immune system to recognize and remember the harmful pathogen, enabling a faster and more effective response if the person is exposed to the actual disease in the future. Vaccines have been instrumental in preventing and eradicating numerous diseases, saving millions of lives worldwide, and are a critical tool in public health efforts to control and eliminate infectious diseases.";
        $meta_keywords = "Vaccine, Vaccination";
        //$meta_title = "Vaccine ";
        $url_canonical = $request->url();
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $vaccineClientList = Product::where('status', 1)->orderBy('updated_at', 'desc')->paginate(config('myconfig.item_per_page'));
        }else{
            $vaccineClientList = Product::where('status', 1)
                ->where(function ($query) use($keyword) {
                    $query->where('name_product', 'like', '%'.$keyword.'%');
                })
            ->orderBy('updated_at', 'desc')
            ->paginate(config('myconfig.item_per_page'));
        }
        return view('client.pages.vaccine.vaccine_list',compact('vaccineClientList','meta_desc','meta_keywords','url_canonical'));
    }

    public function show(string $slug,Request $request )
    {
        $meta_desc = "Vaccine is a biological substance that helps to stimulate an immune response in the body, providing protection against specific infectious diseases. It typically contains weakened or inactivated forms of the disease-causing agent, such as viruses or bacteria, or specific parts of those agents. When administered, vaccines trigger the immune system to recognize and remember the harmful pathogen, enabling a faster and more effective response if the person is exposed to the actual disease in the future. Vaccines have been instrumental in preventing and eradicating numerous diseases, saving millions of lives worldwide, and are a critical tool in public health efforts to control and eliminate infectious diseases.";
        $meta_keywords = "Vaccine, Vaccination";
        //$meta_title = "Vaccine ";
        $url_canonical = $request->url();
        $vaccineClientList = Product::where('slug', $slug)->paginate(config('myconfig.item_per_page'));
        return view('client.pages.vaccine.vaccine_detail', compact('vaccineClientList','meta_desc','meta_keywords','url_canonical'));
    }
}
