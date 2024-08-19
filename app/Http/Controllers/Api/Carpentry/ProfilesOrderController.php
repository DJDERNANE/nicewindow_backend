<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Common\ProfileOrderPaymentStatus;
use App\Common\ProfileOrderStatus;
use App\Http\Controllers\Controller;
use App\Models\CarpentryFavoriteSupplier;
use App\Models\CarpentryProfileOrder;
use App\Models\CarpentryProfileOrderProducts;
use App\Models\CarpentryProfilesOrderCart;
use App\Models\Category;
use App\Models\Color;
use App\Models\User;
use App\Models\Type;
use App\Models\SupplierProfileStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesOrderController extends Controller
{
  function showCategories()
  {
    $categories = Category::all();

    return response()->json(['categories' => $categories], 200);
  }

  public function showSuppliers()
  {
    // if(isset($_GET['categories']))
    // {
      // $categories = json_decode(htmlspecialchars($_GET['categories']));
      // if($categories && count($categories) > 0)
      // {
        $stock = SupplierProfileStock::select('supplier_id')/*->whereIn('category_id', $categories)->distinct()*/->get();
        $stock->load('supplier');
    
        return response()->json(['suppliers' => $stock], 200);
    //   }
    // }

    return response()->json(404);
  }

  public function searchSuppliers()
  {
 
        $data = User::where('type',3)->where('company_name', 'like', '%'.$_GET['search'].'%')->get();
    
        return response()->json(['suppliers' => $data], 200);
      
     
  }

  public function showFavoritesSuppliers()
  {
    $favorites = CarpentryFavoriteSupplier::where('carpentry_id', Auth::id())->get();
    $favorites->load('supplier');

    return response()->json(['favorites' => $favorites], 200);
  }

  public function showSupplierStock(Request $request)
  {
    $request->validate([
      'supplier_id' => 'required|numeric'
    ]);

    $stock = SupplierProfileStock::where([['supplier_id', '=', $request->supplier_id], ['qty', '>', 0]])->with(['color', 'profile', 'type'])->get();


    // foreach ($stock as $item)
    // {
    //   $cart = CarpentryProfilesOrderCart::where([['profile_id', '=', $item->profile_id], ['carpentry_id', '=', Auth::id()], ['supplier_id', '=', $item->supplier_id]])->first();
    //   if($cart)
    //   {
    //     $item['cart'] = true;
    //   }
    // }

    // return response()->json(['stock' => $stock], 200);
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

  public function getQtePrice(Request $request)
  { 
    $color = $request->color;
    $type = $request->type;
    $colorId = Color::where('color_code', $color)->first();
    $typeId = type::where('name', $type)->first();
    if ($request->supplier_id) {
      $stock = SupplierProfileStock::where('supplier_id', $request->supplier_id)->where('typeId', $typeId->id)->where('colorId', $colorId->id)->first();
  }else{
    $stock = SupplierProfileStock::where('supplier_id', Auth::id())->where('typeId', $typeId->id)->where('colorId', $colorId->id)->first();
  }
  
    return response()->json(['success'=>true, 'data'=>$stock]);
  }

  public function store(Request $request)
  {
    $total_price = 0;

    $cart = CarpentryProfilesOrderCart::where('carpentry_id', Auth::id())->get();
    if($cart && count($cart) > 0)
    {
      $create_order = CarpentryProfileOrder::create([
        'carpentry_id' => Auth::id(),
        'supplier_id' => $cart[0]->supplier_id,
        'shipping_address' => $request->shipping_address,
        'shipping_price' => null,
        'total_price' => 0,
        'status' => ProfileOrderStatus::WITING,
        'payment_status' => ProfileOrderPaymentStatus::WITING
      ]);

      foreach ($cart as $item)
      {
        $profile = SupplierProfileStock::where('supplier_id',$item->supplier_id)->where('profile_id',$item->profile_id )->first();
        CarpentryProfileOrderProducts::create([
          'order_id' => $create_order->id,
          'profile_id' => $item->profile_id,
          'qty' => $item->qty,
          'unit_price' => $item->unit_price,
          'profit' => $profile->price - $profile->prixAchat
        ]);

        // add to total price
        $total_price += $item->unit_price*$item->qty;

        // delete item from cart
        $item->delete();
      }

      $create_order->total_price = $total_price;
      $create_order->save();

      return response()->json(['success' => true], 200);
    }

    return response()->json(404);
  }

  public function showOrders()
  {
    $orders = CarpentryProfileOrder::where('carpentry_id', Auth::id())->orderBy('id', 'DESC')->paginate(20);
    $orders->load('supplier');

    return response()->json(['orders' => $orders], 200);
  }

  public function showOrder(CarpentryProfileOrder $order)
  {
    if($order->carpentry_id === Auth::id())
    {
      $order->load('supplier', 'profile_order_products.profile');

      return response()->json(['order' => $order], 200);
    }
  }

  
}
