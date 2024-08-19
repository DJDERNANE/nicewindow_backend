<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'client_name' => 'required|max:255',
      'client_mobile' => 'required|max:20',
      'date' => 'required|max:255',
      'time' => 'required|max:255',
      'lable' => 'nullable|max:255',
    ]);

    $check = Appointment::where([['date', '=', $request->date], ['time', '=', $request->time]])->first();
    if($check)
    {
      return response()->json(['success' => false, 'message' => 'exists'], 200);
    }

    $validateData['date'] = explode('T', $request->date)[0];
    $validateData['time'] = explode('.', explode('T', $request->date)[1])[0];
    $validateData['carpentry_id'] = Auth::id();

    Appointment::create($validateData);

    return response()->json(['success' => true], 200);
  }

  public function show()
  {
    $carpentry_id = Auth::id();

    $appointments = Appointment::where('carpentry_id', $carpentry_id)->orderBy('id', 'DESC')->limit(20)->get();

    return response()->json(['appointments' => $appointments], 200);
  }

  public function finish(Request $request)
  {
    $request->validate([
      'id' => 'required'
    ]);

    $appointment = Appointment::find($request->id);
    if($appointment && $appointment->carpentry_id === Auth::id())
    {
      $appointment->status = 2;
      $appointment->save();

      return response()->json(['success' => true], 200);
    }

    return response()->json(['success' => false], 200);
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required'
    ]);

    $appointment = Appointment::find($request->id);
    if($appointment && $appointment->carpentry_id === Auth::id())
    {
      $appointment->delete();
      return response()->json(['success' => true], 200);
    }

    return response()->json(['success' => false], 200);
  }
}
