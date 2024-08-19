<?php

namespace App\Http\Controllers;

use App\Models\type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validateData = $request->validate([
        'catid' => 'required|numeric',
        'subcatid' => 'required|numeric',
        'name' => 'required',
      ]);
  
      type::create([
        'catid' => $request->catid,
        'subcatid' => $request->subcatid,
        'name' => $request->name,
      ]);
  
      return back();
    }


    public function showBySubCategoryForSelect(Subcategory $subcategory)
  {
    $result = '';

    $types = type::where('subcatid', $subcategory)->get();

    foreach ($types as $type)
    {
      $result .= '<option value="'.$type->id.'">'.$type->name.'</option>';
    }

    return $result;
  }
    /**
     * Display the specified resource.
     */
    public function show(type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      $validateData = $request->validate([
        'catid' => 'required|numeric',
        'subcatid' => 'required|numeric',
        'name' => 'required',
      ]);
  
      $type = type::find($request->id);
      if($type)
      {
        $type->update($validateData);
      }
  
      return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required'
    ]);

    $type = type::find($request->id);
    if($type)
    {
      $type->delete();
    }

    return response()->json(['success' => true], 200);
  }
}
