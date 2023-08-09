<?php

namespace App\Http\Controllers\Client\About_us;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        //seo
        $meta_desc = "Academy vaccine is a type of vaccine developed by the National Academy of Sciences in the United States, with the aim of protecting individuals from infectious diseases.";
        $meta_keywords = "Information about vaccine, introduction about vaccine, avoid disease ";
        //$meta_title = "Blog Academy About Vaccine";
        $url_canonical = $request->url();
        $content = AboutUs::all()->first();
        return view('client.pages.about_us.about_us', compact('meta_desc', 'meta_keywords','url_canonical', 'content'));
    }

}
