<?php

namespace App\Http\Controllers\Api\Supplier\Profile;

use App\Common\ProfileOrderPaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\CarpentryProfileOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Spend;

class AccountingController extends Controller
{
    public function index(){
      $revenu = 0;
      $profit = 0;
      $orders = CarpentryProfileOrder::where('supplier_id',Auth::id())->where('payment_status', '<>', '0')->get();
      if ($orders && count($orders)) {
          foreach ($orders as $order) {
            $revenu += $order->total_price;
            $profit += $order->profit;
          }
    
          return response()->json(['success'=> true, 'revenu'=> $revenu, 'profit' => $profit]);
      } 
    } 
    public function deatils(){
      $paye = 0;
      $credit = 0;
      $orders = CarpentryProfileOrder::where('supplier_id',Auth::id())->get();
      if ($orders && count($orders)) {
          foreach ($orders as $order) {
            $paye += $order->paye;
            $credit += $order->credit;
          }
    
          return response()->json(['success'=> true, 'paye'=> $paye, 'credit' => $credit]);
      } 
    }

    public function PayementDetails(){
      $data = CarpentryProfileOrder::where('supplier_id',Auth::id())->where('status',1)->get();
      $data->load('carpentry');
      return response()->json(['success'=> true, 'data'=> $data]);
      
    }

    public function filter(Request $request){
      $revenu = 0;
      $profit = 0;
      $totalspend = 0;
      $startDate = $request->input('startday');
      $endDate = $request->input('endday');

      if ($request->has('endday')) {

        $formattedStartDate = Carbon::createFromFormat('m/d/Y', $startDate)->format('Y-d-m');
        $formattedEndDate = Carbon::createFromFormat('m/d/Y', $endDate)->format('Y-d-m');

        $orders = CarpentryProfileOrder::where('supplier_id',Auth::id())
                                        ->whereRaw('DATE(created_at) >= ?', [$formattedStartDate])
                                        ->whereRaw('DATE(created_at) <= ?', [$formattedEndDate])->get();
       

        $spends = Spend::where('supplier_id', Auth::id())
        ->whereRaw('DATE(created_at) >= ?', [$formattedStartDate])
        ->whereRaw('DATE(created_at) <= ?', [$formattedEndDate])
        ->get();
        
      } else {
          $formattedStartDate = Carbon::createFromFormat('m/d/Y', $startDate)->format('Y-d-m');

          $orders = CarpentryProfileOrder::where('supplier_id',Auth::id()) ->whereDate('created_at', $formattedStartDate)->get();
          $spends = Spend::where('supplier_id', Auth::id())
          ->whereDate('created_at', $formattedStartDate)
          ->get();
      }

      if ($orders ) {
        foreach ($orders as $order) {
          $revenu += $order->total_price;
          $profit += $order->profit;
        }
      }
      if ($spends) {
        foreach ($spends as $spend) {
          $totalspend += $spend->montant;
      }
      }
    
      return response()->json(['success' => true,'spends'=>$totalspend, 'revenu'=> $revenu, 'profit' => $profit], 200);

  }
  
}
