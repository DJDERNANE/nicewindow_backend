<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    public function store(Request $request)
    {
      $validateData = $request->validate([
        'name' => 'required',
        'price' => 'required|numeric'
      ]);
  
      Extension::create($validateData);
  
      return back();
    }
  
    public function update(Request $request)
    {
      $validateData = $request->validate([
        'id' => 'required|numeric',
        'name' => 'required',
        'price' => 'required|numeric'
      ]);
  
      $Extension = Extension::find($request->id);
      if($Extension)
      {
        $Extension->update($validateData);
      }
  
      return back();
    }
  
    public function destroy(Request $request)
    {
      $request->validate([
        'id' => 'required|numeric'
      ]);
  
      $Extension = Extension::find($request->id);
      if($Extension)
      {
        $Extension->delete();
        
        return response()->json(['success' => true], 200);
      }
    }
}
