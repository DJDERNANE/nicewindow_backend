<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarpentryProfileOrder;
use App\Models\CarpentryClientOrder;
use Illuminate\Support\Facades\Auth;
class PurchasesController extends Controller
{
    public function index(){
        $purchase = 0;
        $orders = CarpentryProfileOrder::where('carpentry_id',Auth::id())->whereNot('payment_status', '0')->get();
      if ($orders && count($orders)) {
          foreach ($orders as $order) {
            $purchase += $order->total_price;
          }
      } 
      return response()->json(['success'=> true, 'purchase'=> $purchase]);
    }


    public function revenu(){
      $revenu = 0;
      $orders = CarpentryClientOrder::where('carpentry_id',Auth::id())->get();
    if ($orders && count($orders)) {
        foreach ($orders as $order) {
          $revenu += $order->total_price;
        }
  
        
    } 
    return response()->json(['success'=> true, 'revenu'=> $revenu]);
  }
}
