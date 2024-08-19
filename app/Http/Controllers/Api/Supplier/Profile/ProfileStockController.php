<?php

namespace App\Http\Controllers\Api\Supplier\Profile;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Type;
use App\Models\Color;
use App\Models\Profile;
use App\Models\Subcategory;
use App\Models\SupplierProfileStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileStockController extends Controller
{
  public function showCategories()
  {
    $categories = Category::all();

    return response()->json(['categories' => $categories], 200);
  }

  public function showSubcategories($category)
  {
    $subcategories = Subcategory::where('category_id', $category)->get();
    return response()->json(['subcategories' => $subcategories], 200);
  }

  public function showProfiles($subcategory)
  {
    $profiles = Profile::where('subcategory_id', $subcategory)->where('supplier_id',0)->get();

    foreach ($profiles as $profile)
    {
      $stock = SupplierProfileStock::where([['supplier_id', '=', Auth::id()], ['profile_id', '=', $profile->id]])->first();
      if($stock)
      {
        $profile['on_stock'] = true;
      }
    }

    $types = type::all();
    $colors = Color::all();
    return response()->json(['profiles' => $profiles, 'types'=> $types, 'colors'=> $colors], 200);
  }

  public function showSupplierProfiles()
  {
    $profiles = Profile::where('supplier_id', Auth::id())->get();
    $types = type::all();
    $colors = Color::all();
    return response()->json(['profiles' => $profiles, 'types'=> $types, 'colors'=> $colors], 200);
  }

  public function show()
  {
    $stock = SupplierProfileStock::where('supplier_id', Auth::id())
        ->with(['color', 'profile', 'type'])
        ->get();

    $profiles = [];

     foreach ($stock as $item) {
      $profileName = $item->profile->name;
      $icon = $item->profile->icon;
      $colorName = $item->color->color_code;
      $type = $item->type->name;
      $profiles[] = [
        'profile_name' => $profileName,
        'icon' => $icon,
        'colors' => $colorName,
        'types' => $type,
    ];
     }

    // Group profiles by name
    $groupedProfiles = collect($profiles)->groupBy('profile_name')->map(function ($group) {
      $firstItem = $group->first();

      // Ensure $colors is always an array
      $colors = $group->pluck('colors')->unique()->all();

      // Ensure $types is always an array
      $types = $group->pluck('types')->unique()->all();

      return [
          'profile_name' => $firstItem['profile_name'],
          'icon' => $firstItem['icon'],
          'types' => $types,
          'colors' => $colors,
      ];
  })->values()->toArray();
  return response()->json(['data' => $groupedProfiles]);
  }

  public function showArticle()
  {
    $stock = SupplierProfileStock::where('supplier_id', Auth::id())->where('profile_name',$_GET['name'])
        ->with(['color', 'profile', 'type'])
        ->get();

  return response()->json(['success'=> true, 'data' => $stock]);
  }

  public function store(Request $request)
  {
    $validateData = $request->validate([
      'profile_id' => 'required|numeric',
      'price' => 'required|numeric',
      'prixAchat' => 'required|numeric',
      'qty' => 'required|numeric',
      'typeId' => 'required|numeric',
      'colorId' => 'required|numeric',
    ]);

    $validateData['supplier_id'] = Auth::id();
    $validateData['category_id'] = Profile::find($request->profile_id)->category_id;
    $validateData['profile_name'] = Profile::find($request->profile_id)->name;
   
    SupplierProfileStock::create($validateData);

    return response()->json(['success' => true], 200);
  }

  public function storeProduct(Request $request)
  {
    $request->validate([
      'category_id' => 'required|numeric',
      'subcategory_id' => 'required|numeric',
      'ref' => 'required|max:255',
      'name' => 'required|max:255',
      'price' => 'required|max:255',
    ]);

  

   Profile::create([
    'category_id'=>$request->category_id,
    'subcategory_id'=>$request->subcategory_id,
    'supplier_id'=>Auth::id(),
    'ref'=>$request->ref,
    'name'=>$request->name,
    'icon'=>'jhkrf',
    'price_bar'=>$request->price,
   ]);

    return response()->json(['success'=>true],200);
  }

  public function update(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
      'price' => 'required|numeric',
      'qty' => 'required|numeric',
      'prixAchat' => 'required|numeric',
    ]);

    $stock = SupplierProfileStock::find($request->id);
    if($stock && $stock->supplier_id === Auth::id())
    {
      $stock->price = $request->price;
      $stock->qty = $request->qty;
      $stock->prixAchat = $request->prixAchat;
      $stock->save();

      return response()->json(['success' => true], 200);
    }
    
    return response()->json(['success' => false], 403);
  }

  public function destroy(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric'
    ]);

    $stock = SupplierProfileStock::find($request->id);
    if($stock && $stock->supplier_id === Auth::id())
    {
      $stock->delete();

      return response()->json(['success' => true], 200);
    }

    return response()->json(['success' => false], 403);
  }
  public function getTypes(Request $request){
    $stock = Profile::where('id', $request->id )
        ->first();
    $types = Type::where('subcatid', $stock->subcategory_id)->get();
    return response()->json(['success' => true, 'types'=> $types], 200);
  }
}
