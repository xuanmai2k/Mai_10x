<?php

namespace App\Http\Controllers\Client\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //seo
        $meta_desc = "Homepages dedicated to vaccines provide important information about the benefits and safety of getting vaccinated. These websites typically offer resources for finding vaccine providers near you, as well as answers to frequently asked questions about the vaccine, such as how it works, who should get vaccinated, and what to expect after vaccination. They may also include information about the latest research and developments related to vaccines. ";
        $meta_keywords = "Home about vaccine, Maivaccine ";
        //$meta_title = "Maivaccine";
        $url_canonical = $request->url();
        $doctorList = Doctor::where('position', 'like' , '%Manager%')->take(4)->get();
        $blogList = Blog::orderBy('updated_at', 'desc')->take(2)->get();
        return view('client.pages.home.home', compact('doctorList', 'blogList','meta_desc', 'meta_keywords','url_canonical'));
    }
}
