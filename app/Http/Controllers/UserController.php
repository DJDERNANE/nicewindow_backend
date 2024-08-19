<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function updateGeneralSettings(Request $request)
  {
    $validateData = $request->validate([
      'firstname' => 'required',
      'lastname' => 'required',
      'email' => 'required|email',
      'phone_number' => 'required',
      'company_name' => 'nullable',
    ]);

    $userId = Auth::id();
    $user = User::find($userId);
    // if($user)
    // {
    //   $checkEmail = User::where([['email', '=', $request->email], ['id', '!=', $request->id]])->first();
    //   if($checkEmail)
    //   {
    //     return back()->with('error', 'البريد الإلكتروني مسجل في حساب آخر.');
    //   }

       $user->update($validateData);

    //   return back()->with('success', 'تم تحديث البيانات بنجاح');
    // }

    
    
    return response()->json(['success'=>true,'extension'=> $validateData]);
  }

  public function updateSecuritySettings(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
      'new_password' => 'required',
      'new_password_confirmation' => 'required|same:new_password'
    ]);

    $user = User::find($request->id);
    if($user)
    {
      $user->password = Hash::make($request->new_password);
      $user->save();

      return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
  }

  public function updateStatus(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric'
    ]);

    $user = User::find($request->id);
    if($user)
    {
      if($user->status === 'blocked')
      {
        $user->status = 'active';
      }
      else
      {
        $user->status = 'blocked';
      }
      $user->save();

      return response()->json(['success' => true], 200);
    }
  }

  public function updateLogo(Request $request){
    
    if($request->hasFile('image')){
      $userId = Auth::id();
      $user = User::find($userId);

      $extension = $request->image->extension();
      $iconName = uniqid('IMG_').'.'.$extension;
      $request->image->storeAs('/public/profiles/icons', $iconName);
      $iconUrl = Storage::url('profiles/icons/'.$iconName);
      // $logoName = $request->file('image')->getClientOriginalName();
      // $request->file('image')->storeAs('public/logos', $logoName);
      // $logoUrl = Storage::url('logos/'.$logoName);
      $user->logo = $iconUrl;
      $user->save();
      return response()->json(['success'=>true]);
    };
  }


  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
    ]);

    $user = User::find($request->id);
    if($user)
    {
      $user->delete();

      return response()->json(['success' => true], 200);
    }
  }
}
