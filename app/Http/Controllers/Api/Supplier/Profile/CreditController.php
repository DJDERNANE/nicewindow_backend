<?php

namespace App\Http\Controllers\Api\supplier\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credit;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{
    public function index($clientId){
        $total=0;
        $credit = Credit::where('supplier_id', Auth::id())->where('carpentry_id', $clientId)->get();
        foreach ($credit as $value) {
            $total += $value->montant;
        }
        return response()->json(['success'=>true, 'data'=> $credit, 'total'=> $total]);
    }
    public function store(Request $request){
        $credit = Credit::create([
            "supplier_id"=> Auth::id(),
            "carpentry_id"=> $request->carpentry_id,
            "montant"=> $request->montant,
            "note"=> $request->note,
        ]);
        if ($credit) {
            return response()->json(['success'=>true]);
        }
        
    }
}
