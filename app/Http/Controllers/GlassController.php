<?php

namespace App\Http\Controllers;

use App\Models\Glass;
use Illuminate\Http\Request;

class GlassController extends Controller
{
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'name_ar' => 'required',
      'name_en' => 'required',
      'name_fr' => 'required',
      'price' => 'required|numeric'
    ]);

    Glass::create($validateData);

    return back();
  }

  public function update(Request $request)
  {
    $validateData = $request->validate([
      'id' => 'required|numeric',
      'name_ar' => 'required',
      'name_en' => 'required',
      'name_fr' => 'required',
      'price' => 'required|numeric'
    ]);

    $glass = Glass::find($request->id);
    if($glass)
    {
      $glass->update($validateData);
    }

    return back();
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric'
    ]);

    $glass = Glass::find($request->id);
    if($glass)
    {
      $glass->delete();
      
      return response()->json(['success' => true], 200);
    }
  }
}
