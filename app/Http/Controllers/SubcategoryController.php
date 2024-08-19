<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'category_id' => 'required|numeric',
      'name_ar' => 'required',
      'name_en' => 'required',
      'name_fr' => 'required'
    ]);

    Subcategory::create($validateData);

    return back();
  }

  public function update(Request $request)
  {
    $validateData = $request->validate([
      'id' => 'required|numeric',
      'category_id' => 'required|numeric',
      'name_ar' => 'required',
      'name_en' => 'required',
      'name_fr' => 'required'
    ]);

    $subcategory = Subcategory::find($request->id);
    if($subcategory)
    {
      $subcategory->update($validateData);
    }

    return back();
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required'
    ]);

    $subcategory = Subcategory::find($request->id);
    if($subcategory)
    {
      $subcategory->delete();
    }

    return response()->json(['success' => true], 200);
  }

  public function showByCategoryForSelect(Category $category)
  {
    $result = '';

    $subcategories = Subcategory::where('category_id', $category->id)->get();

    foreach ($subcategories as $subcategory)
    {
      $result .= '<option value="'.$subcategory->id.'">'.$subcategory->name_ar.'</option>';
    }

    return $result;
  }
}
