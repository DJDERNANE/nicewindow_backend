<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'name_fr' => 'required',
      'name_ar' => 'required',
      'name_en' => 'required',
      'color_code' => 'nullable'
    ]);

    Color::create($validateData);

    return back();
  }

  public function update(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
      'name_ar' => 'required',
      'name_en' => 'required',
      'name_fr' => 'required',
      'color_code' => 'nullable'
    ]);

    $color = Color::find($request->id);
    if($color)
    {
      $color->name_ar = $request->name_ar;
      $color->name_fr = $request->name_fr;
      $color->name_en = $request->name_en;
      $color->color_code = $request->color_code;
      $color->save();
    }

    return back();
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required'
    ]);

    $color = Color::find($request->id);
    if($color)
    {
      $color->delete();
    }

    return response()->json(['success' => true], 200);
  }
}
