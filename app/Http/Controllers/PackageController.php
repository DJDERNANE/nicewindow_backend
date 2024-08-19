<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'name_en' => 'required|max:255',
      'name_ar' => 'required|max:255',
      'name_fr' => 'required|max:255',
      'monthly_price' => 'required|numeric',
      'yearly_price' => 'nullable|numeric',
      'max_users' => 'nullable',
      'max_locations' => 'nullable'
    ]);

    Package::create($validateData);

    return back();
  }

  public function update(Request $request)
  {
    $validateData = $request->validate([
      'id' => 'required|numeric',
      'name_en' => 'required|max:255',
      'name_ar' => 'required|max:255',
      'name_fr' => 'required|max:255',
      'monthly_price' => 'required|numeric',
      'yearly_price' => 'nullable|numeric',
      'max_users' => 'nullable',
      'max_locations' => 'nullable'
    ]);

    $package = Package::find($request->id);
    if($package)
    {
      $package->update($validateData);

      return back();
    }
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric'
    ]);

    $package = Package::find($request->id);
    if($package)
    {
      $package->delete();

      return response()->json(['success' => true], 200);
    }
  }
}
