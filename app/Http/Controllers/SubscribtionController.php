<?php

namespace App\Http\Controllers;

use App\Models\Subscribtion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribtionController extends Controller
{
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'package_id' => 'required|numeric',
      'user_id' => 'required|numeric',
      'start' => 'required',
      'end' => 'required'
    ]);

    $validateData['status'] = 1;
    $validateData['created_by'] = Auth::id();

    Subscribtion::create($validateData);

    return back()->with('success', 'تم تحديث البيانات بنجاح');
  }

  public function update(Request $request)
  {
    $request->validate([
      'subscribtion_id' => 'required|numeric',
      'package_id' => 'required|numeric',
      'start' => 'required',
      'end' => 'required',
      'status' => 'required|numeric'
    ]);

    $subscribtion = Subscribtion::find($request->subscribtion_id);
    if($subscribtion)
    {
      $subscribtion->package_id = $request->package_id;
      $subscribtion->start = $request->start;
      $subscribtion->end = $request->end;
      $subscribtion->status = $request->status;
      $subscribtion->save();

      return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
    ]);

    $subscribtion = Subscribtion::find($request->id);
    if($subscribtion)
    {
      $subscribtion->delete();

      return response()->json(['success' => true], 200);
    }
  }
}
