<?php

namespace App\Http\Controllers\Api\Auth;

use App\Common\UserType;
use App\Http\Controllers\Controller;
use App\Models\Subscribtion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Common\SubscribtionStatus;

class LoginController extends Controller
{
  public function login(Request $request)
  {
    $request->validate([
      //'email' => 'required',
      'phone_number' => 'required',
      'password' => 'required'
    ]);

    $user = User::where('phone_number', $request->phone_number)->first();
    if($user && $user->status !== 'blocked')
    {
      if(Hash::check($request->password, $user->password))
      {
        $device_token = !empty($request->device_token) ? htmlspecialchars(trim($request->device_token)) : '';

        $token = Str::random(100);
        $user->api_token = $token;
        $user->device_token = $device_token;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Connexion réussie', 'user' => $user], 200);
      }
      else
      {
        return response()->json(['success' => false, 'message' => 'Mauvais mot de passe'], 403);
      }
    }
    else
    {
      return response()->json(['success' => false, 'message' => 'L\'utilisateur n\'existe pas'], 404);
    }
  }

  public function check(Request $request)
  {
    $request->validate([
      'token' => 'required'
    ]);

    $user = User::where('api_token', $request->token)->first();
    $emailverfied = $user->email_verified_at;
    if ($emailverfied) {
      $verfied = true;
    }else{
      $verfied = false;
    }
    if($user->master_id)
    {
      return response()->json(['success' => true, 'sub'=> 1, 'verify_email'=> $verfied,'worker' => true], 200);
    }else{
       $subscribtion = Subscribtion::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
        if($subscribtion && $subscribtion->end < date('Y-m-d'))
        {
          $subscribtion->status = SubscribtionStatus::EXPIRED;
          $subscribtion->save();
        }

        return response()->json(['success' => true, 'sub'=> $subscribtion->status, 'verify_email'=> $verfied,'worker' => false], 200);
    }
    return response()->json(['success' => false], 403);
  }
}
