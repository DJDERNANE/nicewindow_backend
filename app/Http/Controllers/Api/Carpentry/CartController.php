<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Http\Controllers\Controller;
use App\Models\CarpentryProfilesOrderCart;
use App\Models\SupplierProfileStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  public function showCount(Request $request)
  {
    $request->validate([
      'supplier_id' => 'required|numeric'
    ]);

    $cart = CarpentryProfilesOrderCart::where([['carpentry_id', '=', Auth::id()], ['supplier_id', '=', $request->supplier_id]])->count();

    return response()->json(['cart' => $cart], 200);
  }

  public function show(Request $request)
  {    
    
    if ($request->supplier_id) {
      $supplier_id = $request->supplier_id;
    }else{
      $supplier_id = Auth::id();
    }
    $cart = CarpentryProfilesOrderCart::where([['carpentry_id', '=', Auth::id()], ['supplier_id', '=', $supplier_id]])->get();
    $cart->load('supplier', 'profile');

    return response()->json(['cart' => $cart], 200);
  }

  public function store(Request $request)
  {
    $request->validate([
      'profile_id' => 'required|numeric',
      'qty' => 'required|numeric',
    ]);
    if ($request->supplier_id) {
      $supplier_id = $request->supplier_id;
    }else{
      $supplier_id = Auth::id();
    }
    $stock = SupplierProfileStock::where([['supplier_id', '=', $supplier_id], ['profile_id', '=', $request->profile_id]])->first();
    
    if($stock)
    {
      $checkCart = CarpentryProfilesOrderCart::where([['supplier_id', '=', $request->supplier_id], ['profile_id', '=', $request->profile_id], ['carpentry_id', '=', Auth::id()]])->first();
      if(!$checkCart)
      {
        CarpentryProfilesOrderCart::Create([
          'carpentry_id' => Auth::id(),
          'supplier_id' => $supplier_id,
          'profile_id' => $request->profile_id,
          'qty' => $request->qty,
          'unit_price' => $stock->price
        ]);

        return response()->json(['success' => true], 200);
      }

      return response()->json(['success' => false], 200);
    }
    
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric'
    ]);

    $cart = CarpentryProfilesOrderCart::find($request->id);
    if($cart && $cart->carpentry_id === Auth::id())
    {
      $cart->delete();

      return response()->json(['success' => true], 200);
    }
  }

  public function empty()
  {
    $cart = CarpentryProfilesOrderCart::where('carpentry_id', Auth::id())->get();
    $cart->delete();

    return response()->json(['success' => true], 200);
  }
}
