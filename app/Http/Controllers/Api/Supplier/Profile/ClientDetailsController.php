<?php

namespace App\Http\Controllers\Api\Supplier\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarpentryProfileOrder;

class ClientDetailsController extends Controller
{
    public function getClientDetails($clientId){
        $orders = CarpentryProfileOrder::where('carpentry_id',$clientId)->get();
        $total = 0;
        $profit = 0;
        $paye = 0;
        $credit = 0;
        foreach ($orders as $order) {
            $total += $order->total_price;
            $profit += $order->profit;
            $paye += $order->paye;
            $credit += $order->credit;
        }
        return response()->json(['success'=>true,
                                'data'=>$orders, 
                                'total'=> $total,
                                'profit'=>$profit,
                                'paye'=>$paye,
                                'credit'=> $credit]);
    }
}
