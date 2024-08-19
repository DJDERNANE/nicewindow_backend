<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Http\Controllers\Controller;
use App\Models\GlassCarpentry;
use App\Models\Aluminium;
use App\Models\Extension;
use App\Models\Volle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CarpentryProductsController extends Controller
{
    public function alms(){
        $alms = Aluminium::where('Carpentry_Id', Auth::id())->get();
        return response()->json(['success'=> true, 'data'=>$alms]);
    }

    public function glass(){
        $glass = GlassCarpentry::where('Carpentry_Id', Auth::id())->get();
        return response()->json(['success'=> true, 'data'=>$glass]);
    }
    
    public function volles(){
        $volles = Volle::where('Carpentry_Id', Auth::id())->get();
        return response()->json(['success'=> true, 'data'=>$volles]);
    }

    public function extensions(){
        $extensions = Extension::where('Carpentry_Id', Auth::id())->get();
        return response()->json(['success'=> true, 'data'=>$extensions]);
    }

    public function addAlm(Request $request){
        Aluminium::create([
            'name' => $request->name,
            'Carpentry_Id'=> Auth::id(),
            'white_price' => $request->whitePrice,
            'colored_price' => $request->coloredPrice
        ]);
        return response()->json(['success'=> true]);
    }

    public function addGlass(Request $request){
        GlassCarpentry::create([
            'name' => $request->name,
            'Carpentry_Id'=> Auth::id(),
            'price' => $request->price
        ]);
        return response()->json(['success'=> true]);
    }

    public function addVolle(Request $request){
        Volle::create([
            'Carpentry_Id'=> Auth::id(),
            'name' => $request->name,
            'price' => $request->price
        ]);
        return response()->json(['success'=> true]);
    }

    public function addExtension(Request $request){
        Extension::create([
            'Carpentry_Id'=> Auth::id(),
            'name' => $request->name,
            'price' => $request->price
        ]);
        return response()->json(['success'=> true]);
    }

    public function updateAlm(Request $request){
        $aluminium = Aluminium::find($request->id);
        if ($aluminium) {
            $aluminium->update([
                'name' => $request->name,
                'Carpentry_Id'=> Auth::id(),
                'name' => $request->name,
                'price' => $request->price
            ]);
            return response()->json(['success'=> true]);
        }
        
    }

    public function updateGlass(Request $request){
        $glass = GlassCarpentry::find($request->id);
        if ($glass) {
            $glass->update([
                'name' => $request->name,
                'Carpentry_Id'=> Auth::id(),
                'price' => $request->price
            ]);
            return response()->json(['success'=> true]);
        }
    }

    public function updateVolle(Request $request){
        $volle = Volle::find($request->id);
        if ($volle) {
            $volle->update([
                'Carpentry_Id'=> Auth::id(),
                'name' => $request->name,
                'price' => $request->price
            ]);
            return response()->json(['success'=> true]);
        }
    }
    public function updateExtension(Request $request){
        $extension = Extension::find($request->id);
        if ($extension) {
            $extension->update([
            'Carpentry_Id'=> Auth::id(),
            'name' => $request->name,
            'price' => $request->price
            ]);
            return response()->json(['success'=> true]);
        }
    }

    public function deleteAlm(Request $request){
        Aluminium::destroy($request->id);
        return response()->json(['success'=> true]);
    }

    public function deleteGlass(Request $request){
        GlassCarpentry::destroy($request->id);
        return response()->json(['success'=> true]);
    }

    public function deleteVolle(Request $request){
        Volle::destroy($request->id);
        return response()->json(['success'=> true]);
    }
    public function deleteExtension(Request $request){
        Extension::destroy($request->id);
        return response()->json(['success'=> true]);
    }


}
