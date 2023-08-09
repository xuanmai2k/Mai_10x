<?php

namespace App\Http\Controllers\Client\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        //seo
        $meta_desc = "Contact tracing is an important tool in preventing the spread of infectious diseases. When someone tests positive for the virus, trained contact tracers work to identify and notify individuals who may have been in close contact with the infected person. This allows them to get tested, monitor their symptoms, and take appropriate measures to protect themselves and others.";
        $meta_keywords = "Contact about vaccine, Consultation about vaccine";
        //$meta_title = "Contact us";
        $url_canonical = $request->url();
        return view('client.pages.contact.contact')
        ->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical);
    }

    public function store(StoreContactRequest $request)
    {
        try{
            DB::beginTransaction();
            $status =0;
            $check = Contact::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'content'=> $request->content,
                'status'=> $status
            ]);
            DB::commit();
            $msg = $check ? 'success' : "failed";
            return redirect()->route('contact')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    public function chatSimsimi(Request $request)
    {
        $utext = $request->utext;

        $url = 'https://wsapi.simsimi.com/190410/talk';

        $headers = [
            'Content-Type' => 'application/json',
            'x-api-key' => env('SIMSIMI_API_KEY'),
        ];

        $response = Http::withHeaders($headers)->post($url, [
            'utext' => $utext,
            'lang' => 'en',
        ]);
        if($response->successful()){
            $responseData = $response->json();
            $atext = $responseData["atext"];
            return $atext;
        }
        return redirect()->route('admin.about-us.index');
    }
}
