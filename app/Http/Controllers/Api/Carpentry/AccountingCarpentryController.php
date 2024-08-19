<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarpentryClientOrder;
use App\Models\CarpentryProfileOrder;
use App\Models\Spend;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AccountingCarpentryController extends Controller
{

  public function filter(Request $request){
    $purchase = 0;
      $revenu = 0;
      $totalspend = 0;
      $revenu = 0;
      $startDate = $request->input('startday');
      $endDate = $request->input('endday');

      if ($request->has('endday')) {

        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $startDate);
        $formattedEndDate = Carbon::createFromFormat('d/m/Y', $endDate);

        $orders = CarpentryProfileOrder::where('carpentry_id',Auth::id())
                                        ->whereRaw('DATE(created_at) >= ?', [$formattedStartDate])
                                        ->whereRaw('DATE(created_at) <= ?', [$formattedEndDate])->get();
        
          $ordersClients = CarpentryClientOrder::where('carpentry_id',Auth::id()) ->whereRaw('DATE(created_at) >= ?', [$formattedStartDate])
          ->whereRaw('DATE(created_at) <= ?', [$formattedEndDate])->get();
        $spends = Spend::where('supplier_id', Auth::id())
        ->whereRaw('DATE(created_at) >= ?', [$formattedStartDate])
        ->whereRaw('DATE(created_at) <= ?', [$formattedEndDate])
        ->get();
        
      } else {
        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $startDate);
        $orders = CarpentryProfileOrder::where('carpentry_id', Auth::id())

            ->whereDate('created_at', '=', $formattedStartDate)
            ->get();          
          $spends = Spend::where('supplier_id', Auth::id())
          ->whereDate('created_at', $formattedStartDate)
          ->get();
          $ordersClients = CarpentryClientOrder::where('carpentry_id',Auth::id())->whereDate('created_at', $formattedStartDate)->get();
      }

      if ($orders ) {
        foreach ($orders as $order) {
          $purchase += $order->total_price;
        }
      }
      if ($spends) {
        foreach ($spends as $spend) {
          $totalspend += $spend->montant;
      }
      }
      if ($ordersClients && count($ordersClients)) {
          foreach ($ordersClients as $order) {
            $revenu += $order->total_price;
          }
      }    
    
      return response()->json(['success' => true,'spends'=>$totalspend, 'revenu'=> $revenu, 'purchase'=>$purchase], 200);

  }

  public function deatils(){
    $paye = 0;
    $credit = 0;
    $orders = CarpentryClientOrder::where('carpentry_id',Auth::id())->get();
    if ($orders && count($orders)) {
        foreach ($orders as $order) {
          $paye += $order->paye;
          $credit += $order->credit;
        }
  
        return response()->json(['success'=> true, 'paye'=> $paye, 'credit' => $credit]);
    } 
  }

  public function PayementDetails(){
    $data = CarpentryClientOrder::where('carpentry_id',Auth::id())->get();
    $data->load('client');
    return response()->json(['success'=> true, 'data'=> $data]);
    
  }
}
