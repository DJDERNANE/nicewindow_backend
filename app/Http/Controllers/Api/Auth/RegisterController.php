<?php

namespace App\Http\Controllers\Api\Auth;

use App\Common\SubscribtionStatus;
use App\Common\UserType;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Subscribtion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
  public function checkEmail(Request $request)
  {
    $email = htmlspecialchars(trim(strtolower($request->email)));
    if(!empty($email))
    {
      $user = User::where('email', $email)->first();
      if($user)
      {
        return response()->json(['success' => false, 'message' => 'Email existe déjà'], 200);
      }

      return response()->json(['success' => true], 200);
    }

    return response()->json(['success' => false, 'message' => 'Email requis'], 200);
  }

  public function checkPhone(Request $request)
  {
    $phone = htmlspecialchars(trim($request->phone));
    if(!empty($phone))
    {
      $user = User::where('phone_number', $phone)->first();
      if($user)
      {
        return response()->json(['success' => false, 'message' => 'Le téléphone existe déjà'], 200);
      }

      return response()->json(['success' => true], 200);
    }

    return response()->json(['success' => false, 'message' => 'Numéro de téléphone requis'], 200);
  }

  public function register(Request $request)
  {
    $validateData = $request->validate([
      'firstname' => 'required',
      'lastname' => 'required',
      //'email' => 'required',
      'phone_number' => 'required',
      'company_name' => 'nullable',
      'password' => 'required',
      'type' => 'required|numeric|min:1|max:3'
    ]);

    $validateData['password'] = Hash::make($request->password);
    $validateData['email'] = '';
    // $min = 100000;
    // $max = 999999;
    // $otp_code = rand($min, $max);
    $device_token = !empty($request->device_token) ? htmlspecialchars(trim($request->device_token)) : '';

    $token = Str::random(100);
    //$validateData['otp_code'] = $otp_code;
    $validateData['api_token'] = $token;
    $validateData['device_token'] = $device_token;
    $validateData['password'] = Hash::make($request->password);
    //Mail::to($request->email)->send(new ConfirmEmail($otp_code));
    $user = User::create($validateData);
    // give 3 days free trial
    if($user->type === 2 || $user->type === 3)
    {
      Subscribtion::create([
        'user_id' => $user->id,
        'start' => Carbon::now(),
        'end' => Carbon::now()->addDays(14),
        'package_id' => Package::first()->id,
        'status' => SubscribtionStatus::ACTIVE
      ]);
    }

    return response()->json(['success' => true, 'user' => $user], 200);
  }
}
