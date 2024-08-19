<?php

namespace App\Http\Controllers\Api\Supplier\Profile;

use App\Http\Controllers\Controller;
use App\Models\CarpentryProfileOrder;
use App\Models\CarpentryProfileOrderProducts;
use App\Models\CarpentryProfilesOrderCart;
use App\Common\ProfileOrderStatus;
use App\Common\ProfileOrderPaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SupplierProfileStock;

class ProfileOrderController extends Controller
{
  public function showOrders()
  {
    $orders = CarpentryProfileOrder::where([['supplier_id', '=', Auth::id()], ['status', '<', 2]])->orderBy('id', 'DESC')->paginate(20);
    $orders->load('carpentry');

    return response()->json(['orders' => $orders], 200);
  }

  public function showHistories()
  {
    $orders = CarpentryProfileOrder::where([['supplier_id', '=', Auth::id()], ['status', '>', 1]])->orderBy('id', 'DESC')->paginate(20);
    $orders->load('carpentry');

    return response()->json(['orders' => $orders], 200);
  }

  public function showOrder(CarpentryProfileOrder $order)
  {
    if($order->supplier_id === Auth::id())
    {
      $order->load('carpentry', 'profile_order_products.profile');

      return response()->json(['order' => $order], 200);
    }
  }

  public function checkOrders()
  {
    $orders = CarpentryProfileOrder::where([['status', '=', 0], ['supplier_id', '=', Auth::id()]])->count();
    return response()->json($orders, 200);
  }

  public function updateStatus(Request $request)
  {
    $request->validate([
      'order_id' => 'required|numeric',
      'status' => 'required|numeric',
    ]);

    $order = CarpentryProfileOrder::find($request->order_id);
    if($order && $order->supplier_id === Auth::id())
    {
      $order->status = $request->status;
      $order->save();

      return response()->json(['success' => true], 200);
    }
  }

  public function credit(Request $request){
    $order = CarpentryProfileOrder::find($request->order_id);
    if($order && $order->supplier_id === Auth::id())
    {
      $order->payment_status = 'credit';
      $order->credit = $order->total_price;
      $order->save();

      return response()->json(['success' => true], 200);
    }
    //return response()->json(['success' => true, 'item'=> $request->order_id], 200);
  }

  public function paye(Request $request){
    $order = CarpentryProfileOrder::find($request->order_id);
    if($order && $order->supplier_id === Auth::id())
    {
      $order->paye = $request->paye;
      $order->credit = $request->credit;

      if ($order->credit == 0) {
        $order->payment_status = 'paye totalement';
      }

      $order->save();

      return response()->json(['success' => true], 200);
    }
    //return response()->json(['success' => true, 'item'=> $request->order_id], 200);
  }

  public function OrderRemise(Request $request){
    $order = CarpentryProfileOrder::find($request->order_id);
    if($order && $order->supplier_id === Auth::id())
    {
      $order->remise = $request->remise;
      $order->total_price = $order->total_price - $order->total_price * $request->remise / 100 ;
      
      $order->save();

      return response()->json(['success' => true], 200);
    }
    
  }

  public function ItemRemise(Request $request){
    $item = CarpentryProfileOrderProducts::find($request->order_id);
    $order = CarpentryProfileOrder::find($item->order_id);
    $item->remise = $request->remise;
    $item->unit_price = $item->unit_price - $item->unit_price * $request->remise / 100 ;
    $item->save();
    $order->total_price = $item->unit_price * $item->qty;
    $order -> save();
    
   

    return response()->json(['success' => true], 200);
    
  }

  public function DeleteOrderRemise(Request $request){
     $order = CarpentryProfileOrder::find($request->order_id);
    if($order && $order->supplier_id === Auth::id())
    {
      $order->total_price = $order->total_price / (1-$order->remise/100);
      $order->remise = 0;
      $order->save();

      return response()->json(['success' => true], 200);
    }
  }

  public function DeleteItemRemise(Request $request){
    $item = CarpentryProfileOrderProducts::find($request->order_id);
    $order = CarpentryProfileOrder::find($item->order_id);
    $item->unit_price = $item->unit_price /( 1- $item->remise / 100) ;
    $item->remise = 0;
    $item->save();
    $order->total_price = $item->unit_price * $item->qty;
    $order -> save();

     return response()->json(['success' => true], 200);
   
 }


  public function destroyOrder(Request $request){
    $order = CarpentryProfileOrderProducts::find($request->order_id);
    $profileOrder = CarpentryProfileOrder::find($order->order_id);
    $profileOrder->total_price = $profileOrder->total_price - $order->unit_price*$order->qty; 
    $profileOrder->save();
    $order->delete();
    return response()->json(['success' => true], 200);
  }

  public function store(Request $request)
  {
    $request->validate([
      'shipping_address' => 'required',
      'carpentry_id' => 'required'
    ]);

    $total_price = 0;
    $total_profit = 0;

    $cart = CarpentryProfilesOrderCart::where('carpentry_id', Auth::id())->get();
    if($cart && count($cart) > 0)
    {
      $create_order = CarpentryProfileOrder::create([
        'carpentry_id' => $request->carpentry_id,
        'supplier_id' => Auth::id(),
        'shipping_address' => $request->shipping_address,
        'shipping_price' => null,
        'total_price' => 0,
        'status' => ProfileOrderStatus::WITING,
        'payment_status' => ProfileOrderPaymentStatus::WITING
      ]);

      foreach ($cart as $item)
      {
        $profile = SupplierProfileStock::where('supplier_id',$item->supplier_id)->where('profile_id',$item->profile_id )->first();
        $orderPro = CarpentryProfileOrderProducts::create([
          'order_id' => $create_order->id,
          'profile_id' => $item->profile_id,
          'qty' => $item->qty,
          'unit_price' => $item->unit_price,
          'profit' => $profile->price - $profile->prixAchat
        ]);

        // add to total price
        $total_price += $item->unit_price*$item->qty;


        $total_profit += $orderPro->profit*$item->qty;
        // delete item from cart
        $item->delete();
      }

      $create_order->total_price = $total_price;
      $create_order->profit = $total_profit;
      $create_order->save();

      return response()->json(['success' => true], 200);
    }

    return response()->json(404);
  }

  public function search(Request $request)
  {
      $query = $request->input('query');
  
      $orders = CarpentryProfileOrder::where([
              ['supplier_id', '=', Auth::id()],
              ['status', '<', 2],
          ])
          ->when($query, function ($queryBuilder) use ($query) {
              // Add a condition to search by carpentry name if $query is present
              return $queryBuilder->whereHas('carpentry', function ($carpentryQuery) use ($query) {
                  $carpentryQuery->where('firstname', 'like', '%' . $query . '%');
              });
          })
          ->orderBy('id', 'DESC')
          ->paginate(20);
  
      $orders->load('carpentry');
  
      return response()->json(['orders'=>$orders, 'success'=> true]);
  }
}
