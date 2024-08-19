<?php

namespace App\Http\Controllers\Api\Supplier\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SupplierFavoriteClients;

class FavorisClientsController extends Controller
{
    public function store(Request $request){
            $request->validate([
        'client_id' => 'required|numeric'
        ]);

        $check = SupplierFavoriteClients::where([['client_id', '=', $request->client_id], ['supplier_id', '=', Auth::id()]])->first();
        if(!$check)
        {
            SupplierFavoriteClients::create([
            'supplier_id' => Auth::id(),
            'client_id' => $request->client_id
        ]);
        }
        else
        {
        $check->delete();
        }

        return response()->json(['success' => true], 200);
    }

    public function getFavoris(){
        $favorites = SupplierFavoriteClients::where('supplier_id', Auth::id())->get();
        $favorites->load('clients');
        $res = [];
        if (!empty($favorites)) {
           foreach($favorites as $favorite){
            $res[] = $favorite->clients;
           }
            return response()->json(['res' => $res], 200);
        }
       
    }
}
