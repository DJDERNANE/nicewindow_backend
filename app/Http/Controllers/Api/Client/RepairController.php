<?php

namespace App\Http\Controllers\Api\Client;

use App\Common\UserType;
use App\Helpers\Geolocation;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLocation;
use Illuminate\Http\Request;

class RepairController extends Controller
{
  public function show(Request $request)
  {
    $request->validate([
      'latitude' => 'required|max:50',
      'longitude' => 'required|max:50'
    ]);

    $latitude = $request->latitude;
    $longitude = $request->longitude;
    $maxDistance = 5;

    $nearby = UserLocation::select('*')->selectRaw("(6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) AS distance")
    ->having('distance', '<=', $maxDistance)
    ->orderBy('distance')
    ->get();

    $nearby->load('user');

    return response()->json(['carpentries' => $nearby], 200);
  }
}
