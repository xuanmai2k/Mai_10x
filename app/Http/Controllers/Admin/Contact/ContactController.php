<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $contactList = Contact::where('status', 0)->orderBy('updated_at', 'desc')->paginate(config('myconfig.item_per_page'));
        }else{
            $contactList = Contact::where('status', 0)
                ->where(function ($query) use($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('phone', 'like', '%'.$keyword.'%')
                    ->orWhere('email', 'like', '%'.$keyword.'%');
                })
            ->orderBy('updated_at', 'desc')
            ->paginate(config('myconfig.item_per_page'));
        }
        return view('admin.pages.contact.list_contact',compact('contactList'));
    }

    public function completeList(Request $request)
    {
        $keyword = $request->keyword;
        if(is_null($keyword)){
            $comContactList = Contact::where('status', 1)->orderBy('updated_at', 'desc')->paginate(config('myconfig.item_per_page'));
        }else{
            $comContactList = Contact::where('status', 1)
                ->where(function ($query) use($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('phone', 'like', '%'.$keyword.'%')
                    ->orWhere('email', 'like', '%'.$keyword.'%');
                })
            ->orderBy('updated_at', 'desc')
            ->paginate(config('myconfig.item_per_page'));
        }
        return view('admin.pages.contact.list_called_contact',compact('comContactList'));
    }

    public function changeStatus(string $id)
    {
        try{
            DB::beginTransaction();
            $check = DB::table('contact')
            ->where('id', $id)
            ->update([
                'status'=>1
            ]);
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('admin.contact.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
