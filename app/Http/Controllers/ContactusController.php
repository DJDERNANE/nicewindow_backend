<?php

namespace App\Http\Controllers;

use App\Models\Contactus;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'fullname' => 'required|max:150',
      'email' => 'required|email',
      'phone_number' => 'required|max:16|min:8',
      'subject' => 'required|max:255',
      'message' => 'required|max:2500'
    ]);

    $validateData['ip'] = $_SERVER['REMOTE_ADDR'];
    $validateData['status'] = 'unread';

    Contactus::create($validateData);

    return back()->with(['success' => 'Message successfuly sent.']);
  }

  public function read(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric'
    ]);

    $message = Contactus::find($request->id);
    if($message)
    {
      $message->status = 'seen';
      $message->save();

      return response()->json(['success' => true]);
    }
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric'
    ]);

    $message = Contactus::find($request->id);
    if($message)
    {
      $message->delete();

      return response()->json(['success' => true]);
    }
  }
}
