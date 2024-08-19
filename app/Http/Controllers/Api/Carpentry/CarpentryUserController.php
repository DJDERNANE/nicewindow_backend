<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Common\UserType;
use App\Http\Controllers\Controller;
use App\Models\Subscribtion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ConfirmEmail;

class CarpentryUserController extends Controller
{
    public function show()
  {
    $users = User::where('master_id', Auth::id())->orderBy('id', 'DESC')->limit(20)->get();
    return response()->json(['users' => $users], 200);
  }

  public function store(Request $request)
  {
    $validateData = $request->validate([
      'firstname' => 'required|max:255',
      'lastname' => 'required|max:255',
      'email' => 'required|email',
      'password' => 'required',
      'phone_number' => 'required'
    ]);

    $subscribtion = Subscribtion::where('user_id', Auth::id())->orderBy('id', 'DESC')->first();
    $subscribtion->load('package');
    if($subscribtion && $subscribtion->package)
    {
      $users_count = User::where('master_id', Auth::id())->count();
      if($users_count >= $subscribtion->package->max_users)
      {
        return response()->json(['success' => false, 'message' => 'You cant add more users.'], 200);
      }

      $checkEmail = User::where('email', $request->email)->first();
      if($checkEmail)
      {
        return response()->json(['success' => false, 'message' => 'Email already exists.'], 200);
      }
  
      $master = User::find(Auth::id());
      if($master)
      {
        $validateData['master_id'] = $master->id;
        $validateData['type'] = UserType::CARPENTRY;
        $validateData['password'] = Hash::make($request->password);
        $validateData['company_name'] = $master->company_name;
        $device_token = !empty($request->device_token) ? htmlspecialchars(trim($request->device_token)) : '';
        $min = 100000;
        $max = 999999;
        $otp_code = rand($min, $max);
        $token = Str::random(100);
        $validateData['otp_code'] = $otp_code;
        $validateData['api_token'] = $token;
        Mail::to($request->email)->send(new ConfirmEmail($otp_code));
        User::create($validateData);
  
        return response()->json(['success' => true], 200);
      }
    }

    return response()->json(['success' => false], 200);
  }

  public function update(Request $request)
  {
    $validateData = $request->validate([
      'id' => 'required|numeric',
      'firstname' => 'required|max:255',
      'lastname' => 'required|max:255',
      'email' => 'required|email',
      'password' => 'nullable',
      'phone_number' => 'required'
    ]);

    $user = User::find($request->id);
    if($user && $user->master_id === Auth::id())
    {
      if(empty($request->password))
      {
        unset($validateData['password']);
      }
      else
      {
        $validateData['password'] = Hash::make($request->password);
      }

      $checkEmail = User::where([['email', '=', $request->email], ['id', '!=', $request->id]])->first();
      if($checkEmail)
      {
        return response()->json(['success' => false, 'message' => 'Email already exists.'], 200);
      }

      $user->update($validateData);

      return response()->json(['success' => true], 200);
    }

    return response()->json(['success' => false, 'message' => 'Something wrong.'], 200);
  }

  public function updateStatus(Request $request) {
    $request->validate([
      'user_id' => 'required|numeric'
    ]);

    $user = User::find($request->user_id);
    if($user && $user->master_id === Auth::id())
    {
      $user->status = $user->status === 'blocked' ? 'active' : 'blocked';
      $user->save();

      return response()->json(['success' => true], 200);
    }

    return response()->json(['success' => false, 'message' => 'Something wrong.'], 200);
  }
}
