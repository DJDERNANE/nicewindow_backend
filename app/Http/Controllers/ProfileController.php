<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
  public function store(Request $request)
  {
    $validateData = $request->validate([
      'category_id' => 'required|numeric',
      'subcategory_id' => 'required|numeric',
      'ref' => 'required|max:255',
      'name' => 'required|max:255',
      'icon' => 'required|mimes:jpg,png,jpeg,svg',
      'weight' => 'nullable|max:255',
      'height' => 'nullable|max:255',
      'price_m' => 'nullable|max:255',
      'price_bar' => 'nullable|max:255',
    ]);

    $extension = $request->icon->extension();
    $iconName = uniqid('IMG_').'.'.$extension;
    $request->icon->storeAs('/public/profiles/icons', $iconName);
    $iconUrl = Storage::url('profiles/icons/'.$iconName);

    $validateData['icon'] = $iconUrl;

    Profile::create($validateData);

    return back();
  }

  public function update(Request $request)
  {
    $validateData = $request->validate([
      'id' => 'required|numeric',
      'category_id' => 'required|numeric',
      'subcategory_id' => 'required|numeric',
      'ref' => 'required|max:255',
      'name' => 'required|max:255',
      'icon' => 'nullable|mimes:jpg,png,jpeg,svg',
      'weight' => 'nullable|max:255',
      'height' => 'nullable|max:255',
      'price_m' => 'nullable|max:255',
      'price_bar' => 'nullable|max:255',
    ]);

    $profile = Profile::find($request->id);
    if($profile)
    {
      if($request->icon)
      {
        $extension = $request->icon->extension();
        $iconName = uniqid('IMG_').'.'.$extension;
        $request->icon->storeAs('/public/profiles/icons', $iconName);
        $iconUrl = Storage::url('profiles/icons/'.$iconName);
        $validateData['icon'] = $iconUrl;
      }
      else
      {
        $validateData['icon'] = $profile->icon;
      }

      $profile->update($validateData);

      return back();
    }
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required'
    ]);

    $profile = Profile::find($request->id);
    if($profile)
    {
      $profile->delete();
    }

    return response()->json(['success' => true], 200);
  }
}
