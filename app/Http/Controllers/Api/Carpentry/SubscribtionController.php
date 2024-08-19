<?php

namespace App\Http\Controllers\Api\Carpentry;

use App\Common\SubscribtionStatus;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Subscribtion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubscribtionController extends Controller
{
  public function show()
  {
    $subscribtion = Subscribtion::where('user_id', Auth::id())->orderBy('id', 'DESC')->first();
    $subscribtion->load('package');

    return response()->json(['subscribtion' => $subscribtion], 200);
  }

  public function store(Request $request)
  {
    $request->validate([
      'package_id' => 'required|numeric|exists:packages,id',
      'proof' => 'required|mimes:jpg,jpeg|max:3072',
      'delay' => 'required|numeric|min:1|max:12'
    ]);

    $extension = $request->proof->extension();
    $proofName = uniqid('PROOF_').'.'.$extension;
    $request->proof->storeAs('/public/carpentry/proofs', $proofName);
    $proofUrl = Storage::url('carpentry/proofs/'.$proofName);

    $subscribtion = Subscribtion::create([
      'user_id' => Auth::id(),
      'start' => date('Y-m-d'),
      'end' => date('Y-m-d', strtotime(date('Y-m-d').' + ' . $request->delay . ' month')),
      'package_id' => $request->package_id,
      'status' => SubscribtionStatus::WAITING,
      'file' => $proofUrl
    ]);

    // send notification to admin
    AdminNotification::create([
      'content' => 'هناك طلب ترقية عضوية جديد',
      'url' => route('admin.user', ['user' => $subscribtion->user_id]),
      'status' => 0
    ]);

    return response()->json(['success' => true], 200);
  }
}
