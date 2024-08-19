<?php

namespace App\Http\Controllers;

use App\Models\CarpentryProfileOrder;
use Illuminate\Http\Request;

class CarpentryProfileOrderController extends Controller
{
  public function updateStatus(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
      'status' => 'required|numeric|max:3'
    ]);

    $order = CarpentryProfileOrder::find($request->id);
    if($order)
    {
      $order->status = $request->status;
      $order->save();

      return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
  }
}
