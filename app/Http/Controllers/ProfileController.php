<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

    // public function update(Request $request): RedirectResponse
    // {
    //     // $request->user()->fill($request->validated());
    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }
    //     // $request->user()->save();
    //     // return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $fileName = auth()->user()->image_url; // nếu không có ảnh update
        if($request->hasFile('image_url')){ // kiểm tra xem có file up lên ko
            $originName= $request->file('image_url')->getClientOriginalName();//lấy tên cũ của ảnh
            $fileName= pathinfo($originName, PATHINFO_FILENAME); // gắn thêm đường dẫn
            $extension = $request->file('image_url')->getClientOriginalExtension();// .jpg
            $fileName = $fileName.'_'.time().'.'.$extension; // thêm time để nó là unique
            $request->file('image_url')->move(public_path("images/client/"), $fileName); // di chuyển đến folder

            //remove old images
            if(!is_null(auth()->user()->image_url)&& file_exists("images/client/".auth()->user()->image_url)){
                unlink("images/client/".auth()->user()->image_url);
            }
        }

        $check = User::find(auth()->user()->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'dob' => $request->dob,
            'image_url' => $fileName
        ]);

        $msg = $check ? 'success' : 'failed';
        return Redirect::route('account.index')->with('message', $msg);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
