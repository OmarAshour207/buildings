<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    public function userDataInfo()
    {
        $user = Auth::user();
        return view('website.profile.edit', compact('user'));
    }

    public function updateUserDataInfo(Request $request, User $user)
    {
        $user = Auth::user();
        $request->validate([
            'name'      => 'required|string',
            'email'     => ['required', Rule::unique('users')->ignore($user->id)],
            'image'     => 'sometimes|nullable|image',
        ]);

        $request_data = $request->except('image', '_token', '_method');

        if($request->image) {
            if($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/user_images/'. $user->image);
            }
            Image::make($request->image)->resize(300, null,  function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }

        $user->update($request_data);
        session()->flash('success', 'تم تحديث بياناتك بنجاح');
        return redirect()->route('home');
    }

    public function updateUserPassword(Request $request, User $user)
    {
        $user = Auth::user();
        $request->validate([
            'oldpassword'   => 'string|required',
            'password'      => 'required|string|confirmed'
        ]);


        if(Hash::check($request->oldpassword, $user->password))  {
            $user->update(['password' => bcrypt($request->password)]);
            session()->flash('success', 'تم تعديل كلمه السر بنجاح');
            return redirect()->back();
        } else {
            session()->flash('error', 'كلمه السر القديمه خاطئه');
            return redirect()->back();
        }
    }
}
