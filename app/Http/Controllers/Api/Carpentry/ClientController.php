<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Http\Controllers\Controller;
use App\Models\CarpentryClient;
use App\Models\CarpentryClientOrder;
use App\Models\shape;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
  function show()
  {
    $clients = CarpentryClient::where('carpentry_id', Auth::id())->orderBy('id', 'DESC')->get();

    return response()->json(['clients' => $clients], 200);
  }

  function client(Request $request)
  {
    $clients = CarpentryClient::find($request->input('id'));

    return response()->json(['clients' => $clients], 200);
  }

  function store(Request $request)
  {
    $validateData = $request->validate([
      'name' => 'required|max:255',
      'phone_number' => 'required|max:14|min:9',
      'notes' => 'nullable|max:1000'
    ]);

    $validateData['carpentry_id'] = Auth::id();

    $create = CarpentryClient::create($validateData);

    return response()->json(['success' => true, 'client' => $create], 200);
  }



  public function shapeStore(Request $request){
    $shape = shape::create([
      'client_id'=> $request->id,
      'shape'=> $request->shape,
    ]);
    return response()->json(['success'=>$request->shape]);
  }

  public function getShapes(Request $request){
    $shapes = shape::where('client_id', $request->input('id'))->where('confirmed', false)->get();
    return response()->json(['success'=>true, 'data'=>$shapes]);
  }

  public function getShapesConfirmed(Request $request){
    $shapes = shape::where('client_id', $request->input('id'))->where('confirmed', $_GET['orderId'])->get();
    return response()->json(['success'=>true, 'data'=>$shapes]);
  }
  public function deleteShape(Request $request){
    $shape = shape::destroy($request->id);
    return response()->json(['success'=>true]);
  }
  public function updateShape(Request $request){
    $shape = shape::find($request->id);
    $shape->shape = $request->shape;
    $shape->save();
    return response()->json(['success'=>true]);
  }
  public function getcolor(){
    $colors = Color::all();
    return response()->json(['data'=>$colors]);
  }

  public function orderpayement(Request $request){
    if ($request->credit !== 0) {
      $payment_status = 'credit';
    }else{
      $payment_status = 'payet totalment';
    }

    $order = CarpentryClientOrder::create([
      'client_id' => $request->client_id,
      'carpentry_id'=> Auth::id(),
      'total_price'=> $request->total_price,
      'promotion' => $request->promotion,
      'payment_status' => $payment_status,
      'paye'=> $request->paye,
      'credit'=> $request->credit
    ]);

    foreach ($request->shapes as $shapeData) {
      $shape = shape::findOrFail($shapeData['id']);
      $shape->confirmed = $order->id;
      $shape->save();
    }
    

      return response()->json(['success' => true], 200);
  }


  public function creditpayement(Request $request){
    if ($request->credit !== 0) {
      $payment_status = 'credit';
    }else{
      $payment_status = 'payet totalment';
    }
    $order = CarpentryClientOrder::findOrFail($request->orderId);
    if ($order) {
      $order->update([
        'payment_status' => $payment_status,
        'paye'=> $request->paye,
        'credit'=> $request->credit
    ]);
    }
      return response()->json(['success' => true], 200);
  }

  public function getOrdersConfirmed(){
    $orders = CarpentryClientOrder::where('carpentry_id', Auth::id())->where('client_id', $_GET['client_id'])->get();

    return response()->json(['success' => true, 'data'=> $orders], 200);
  }
  
}
