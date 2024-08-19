<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  public function form()
  {
    return view('admin.auth.login');
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();
    //dd($user);
    if($user && $user->status !== 'blocked' && intval($user->type) === 0)
    {
      if(Hash::check($request->password, $user->password))
      {
        Auth::login($user, 'remember');

        return redirect()->route('admin.home');
      }
      else
      {
        return back()->with('error', 'البريد الإلكتروني أو كلمة المرور خاطئة.');
      }
    }
    else
    {
      return back()->with('error', 'البريد الإلكتروني أو كلمة المرور خاطئة.');
    }
  }
}
