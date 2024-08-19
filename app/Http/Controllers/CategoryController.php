<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'name_fr' => 'required',
      'name_ar' => 'required',
      'name_en' => 'required'
    ]);

    Category::create($validateData);

    return back();
  }

  public function update(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
      'name_ar' => 'required',
      'name_en' => 'required',
      'name_fr' => 'required'
    ]);

    $category = Category::find($request->id);
    if($category)
    {
      $category->name_ar = $request->name_ar;
      $category->name_fr = $request->name_fr;
      $category->name_en = $request->name_en;
      $category->save();
    }

    return back();
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required'
    ]);

    $category = Category::find($request->id);
    if($category)
    {
      $category->delete();
    }

    return response()->json(['success' => true], 200);
  }
}
