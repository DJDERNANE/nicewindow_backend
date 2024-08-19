<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
  public function show()
  {
    $packages = Package::all();

    return response()->json(['packages' => $packages], 200);
  }
}
