<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierClient;
use Illuminate\Support\Facades\Auth;

class SupplierClients extends Controller
{
    public function storeClient(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company_name' => 'nullable',
           
          ]);
          $validateData['supplier_id'] = Auth::id();
          SupplierClient::Create($validateData);
        return response()->json(['success'=>true], 200); 
    }

    public function getClients(){
        $clients = SupplierClient::where('supplier_id', Auth::id())->get();
        return response()->json(['success'=>true, 'res'=> $clients], 200); 
    }

    public function deleteClient(Request $request){
        $client = SupplierClient::destroy($request->user_id);
        return response()->json(['success'=>true], 200); 
    }

    
    public function getFavoris(){
        return response()->json(['success'=>true], 200); 
    }
}
