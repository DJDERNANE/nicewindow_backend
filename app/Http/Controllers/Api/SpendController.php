<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spend;
use Illuminate\Support\Facades\Auth;


class SpendController extends Controller
{
    public function store(Request $request){
        $spend = Spend::create([
            "supplier_id"=> Auth::id(),
            "montant"=>$request->montant,
            "note"=>$request->note
        ]);
        if($spend){
            return response()->json(['success'=> true],200);
        }
       
    }

    public function index(){
        $spends = Spend::where('supplier_id', Auth::id())->get();
        $totalspend = 0;
        foreach ($spends as $spend) {
            $totalspend += $spend->montant;
        };  
        return response()->json(['success'=> true, 'spends'=> $totalspend],200);
    }

    public function SpendDetails(){
        $spend = Spend::where('supplier_id', Auth::id())->get();
        return response()->json(['success'=> true, 'spends'=> $spend],200);
    }

   
}
