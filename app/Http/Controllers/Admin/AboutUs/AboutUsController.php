<?php

namespace App\Http\Controllers\Admin\AboutUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutUs\StoreAboutUsRequest;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AboutUsController extends Controller
{
    public function index()
    {
        $content = AboutUs::all();
        return view('admin.pages.about-us.content_about_us',compact('content'));
    }

    public function create()
    {
        return view('admin.pages.about-us.create_about_us');
    }

    public function chatGpt(Request $request)
    {
        $content = $request->content;
        $url = 'https://api.openai.com/v1/chat/completions';
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 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' //env('CHATGPT_SECRET_KEY');
        ];

        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "You are a helpful assistant."
                ],
                [
                    "role" => "user",
                    "content" => $content
                ]
            ]
        ];

        $response = Http::withHeaders($headers)->post($url, $data);

        if ($response->successful()) {
            $responseData = $response->json();
            $res = $responseData['choices'][0]['message']['content'];
            return $res;
        }
        return redirect()->route('');
    }

    public function store(StoreAboutUsRequest $request)
    {
        DB::table('about_us')->delete();
        try{
            DB::beginTransaction();
            $check = AboutUs::create([
                'description'=> $request->description,
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.aboutus.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images/admin/aboutus/'), $fileName);

            $url = asset('images/admin/aboutus/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
