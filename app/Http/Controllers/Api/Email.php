<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class Email extends Controller
{
    public function Confirm(Request $request){
        $request->validate([
            'otp_code' => 'required',
            'token' => 'required'
        ]);
        $user = User::where('api_token', $request->token)->where('otp_code', $request->otp_code)->first();
        if ($user) {
            $user->email_verified_at = Carbon::today();
            $user->save();
            return response()->json(['success' => true], 200);
        }
        return response()->json(['success' => false], 200);
    }
}   
