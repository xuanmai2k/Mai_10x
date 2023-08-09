<?php

namespace App\Http\Controllers\Client\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        //seo
        $meta_desc = "Academy vaccine is a type of vaccine developed by the National Academy of Sciences in the United States, with the aim of protecting individuals from infectious diseases.";
        $meta_keywords = "Information about vaccine, introduction about vaccine, avoid disease ";
        //$meta_title = "Blog Academy About Vaccine";
        $url_canonical = $request->url();
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $blogClientList = Blog::where('status', 1)->orderBy('updated_at','desc')->paginate(config('myconfig.item_per_page'));
        }else{
            $filter = [];
            if(!is_null( $keyword )){
                $filter[]=['name', 'like', '%'.$keyword.'%'];
                $filter[]=['status',1];
            }
            $blogClientList = Blog::where($filter)->orderBy('updated_at','desc')->paginate(config('myconfig.item_per_page'));
        }
        return view('client.pages.blog.blog_list', compact('blogClientList', 'meta_desc', 'meta_keywords','url_canonical'));
    }

    public function show(string $slug, Request $request)
    {
        //seo
        $meta_desc = "Academy vaccine is a type of vaccine developed by the National Academy of Sciences in the United States, with the aim of protecting individuals from infectious diseases.";
        $meta_keywords = "Information about vaccine, introduction about vaccine, avoid disease ";
        //$meta_title = "Blog Academy About Vaccine";
        $url_canonical = $request->url();
        $blogClientList = Blog::where('slug', $slug)->paginate(config('myconfig.item_per_page'));
        return view('client.pages.blog.blog_detail', compact('blogClientList', 'meta_desc', 'meta_keywords','url_canonical'));
    }
}
