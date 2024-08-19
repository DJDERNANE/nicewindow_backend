<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Http\Controllers\Controller;
use App\Models\CarpentryFavoriteSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteSupplierController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'supplier_id' => 'required|numeric'
    ]);

    $check = CarpentryFavoriteSupplier::where([['supplier_id', '=', $request->supplier_id], ['carpentry_id', '=', Auth::id()]])->first();
    if(!$check)
    {
      CarpentryFavoriteSupplier::create([
        'carpentry_id' => Auth::id(),
        'supplier_id' => $request->supplier_id
      ]);
    }
    else
    {
      $check->delete();
    }

    return response()->json(['success' => true], 200);
  }

  public function check(Request $request)
  {
    $request->validate([
      'supplier_id' => 'required|numeric'
    ]);

    $check = CarpentryFavoriteSupplier::where([['supplier_id', '=', $request->supplier_id], ['carpentry_id', '=', Auth::id()]])->first();
    if($check)
    {
      return response()->json(['success' => true], 200);
    }
    return response()->json(['success' => false], 200);
  }
}
