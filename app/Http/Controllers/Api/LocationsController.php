<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Geolocation;
use App\Http\Controllers\Controller;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationsController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'address' => 'required|max:255',
      'responsible_name' => 'required|max:255',
      'responsible_mobile' => 'required|max:255'
    ]);

    UserLocation::create([
      'user_id' => Auth::id(),
      'user_type' => Auth::user()->type,
      'address' => $request->address,
      'latitude' => Geolocation::get_lat_lon($request->address)['latitude'],
      'longitude' => Geolocation::get_lat_lon($request->address)['longitude'],
      'responsible_name' => $request->responsible_name,
      'responsible_mobile' => $request->responsible_mobile
    ]);

    return response()->json(['success' => true], 200);
  }

  public function show()
  {
    $locations = UserLocation::where('user_id', Auth::id())->limit(10)->get();

    return response()->json(['locations' => $locations], 200);
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric'
    ]);

    $location = UserLocation::find($request->id);
    if($location && $location->user_id === Auth::id())
    {
      $location->delete();

      return response()->json(['success' => true], 200);
    }
  }
}
