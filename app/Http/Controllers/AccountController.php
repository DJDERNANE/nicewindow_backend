<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
  public function updateGeneralSettings(Request $request)
  {
    $request->validate([
      'firstname' => 'required|max:200',
      'lastname' => 'required|max:200',
      'email' => 'required|email',
      'phone_number' => 'required'
    ]);

    $user = User::find(Auth::id());
    if($user)
    {
      $user->firstname = $request->firstname;
      $user->lastname = $request->lastname;
      $user->email = $request->email;
      $user->phone_number = $request->phone_number;
      $user->save();

      return back()->with('success', 'لقد تم تحديث البيانات بنجاح');
    }
  }

  public function updateProfilepicSettings(Request $request)
  {
    $request->validate([
      'image' => 'required|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    $extension = $request->image->extension();
    $imageName = uniqid('IMG_').'.'.$extension;
    $request->image->storeAs('/public/admin/profile', $imageName);
    $imageUrl = Storage::url('admin/profile/'.$imageName);

    $user = User::find(Auth::id());
    if($user)
    {
      $user->profile_photo_path = $imageUrl;
      $user->save();

      return back();
    }
  }

  public function updateSecuritySettings(Request $request)
  {
    $request->validate([
      'current_password' => 'required',
      'new_password' => 'required',
      'confirm_new_password' => 'required|same:new_password'
    ]);

    $user = User::find(Auth::id());
    if($user)
    {
      if(Hash::check($request->current_password, $user->password))
      {
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'لقد تم تحديث البيانات بنجاح');
      }
      return back()->with('error', 'كلمة المرور الحالية خاطئة');
    }
  }
}
