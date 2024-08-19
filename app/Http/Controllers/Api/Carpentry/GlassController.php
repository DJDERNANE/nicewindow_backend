<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Http\Controllers\Controller;
use App\Models\Glass;
use Illuminate\Http\Request;

class GlassController extends Controller
{
  public function show()
  {
    $glasses = Glass::limit(10)->get();
    return response()->json(['glasses' => $glasses], 200);
  }
}
