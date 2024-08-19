@extends('layouts.admin.app')

@section('content')
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-body">
          <h2 class="fw-bold">الطلب #{{ $order->id }}</h2>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if(session()->has('error'))
            <div class="alert alert-danger">
              {{ session()->get('error') }}
            </div>
          @endif
          @if(session()->has('success'))
            <div class="alert alert-success">
              {{ session()->get('success') }}
            </div>
          @endif

          <form action="{{ route('admin.order.profile.status.update') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">النجار: </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <a href="{{ route('admin.user', ['user' => $order->carpentry_id]) }}">
                      <span class="input-group-text border-2" id="inputGroup-sizing-default">
                        <ion-icon name="person-outline" class="my-1"></ion-icon>
                      </span>
                    </a>
                  </div>
                  <input type="text" class="form-control border-2" aria-label="Default" aria-describedby="inputGroup-sizing-default" readonly value="{{ $order->carpentry->firstname.' '.$order->carpentry->lastname }}" />
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">الناقل: </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <a href="{{ route('admin.user', ['user' => $order->supplier_id]) }}">
                      <span class="input-group-text border-2" id="inputGroup-sizing-default">
                        <ion-icon name="person-outline" class="my-1"></ion-icon>
                      </span>
                    </a>
                  </div>
                  <input type="text" class="form-control border-2" aria-label="Default" aria-describedby="inputGroup-sizing-default" readonly value="{{ $order->supplier->firstname.' '.$order->supplier->lastname }}" />
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">العنوان: </label>
              <input type="text" class="form-control border-2" readonly value="{{ $order->shipping_address }}" />
            </div>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">السعر: </label>
                <input type="text" class="form-control border-2" readonly value="{{ $order->total_price }} د.ج" />
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">حالة الطلب: </label>
                <select class="form-control border-2" name="status">
                  <option value="0" {{ intval($order->status) === 0 ? 'selected' : '' }}>قيد الإنتظار</option>
                  <option value="1" {{ intval($order->status) === 1 ? 'selected' : '' }}>قيد التوصيل</option>
                  <option value="2" {{ intval($order->status) === 2 ? 'selected' : '' }}>منتهية</option>
                  <option value="3" {{ intval($order->status) === 3 ? 'selected' : '' }}>ملغية</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">حالة الدفع: </label>
                <input type="text" class="form-control border-2" readonly value="{{ $order->payment_status === 0 ? 'قيد الإنتظار' : 'تم الدفع' }}" />
              </div>
            </div>
            <div class="mb-3">
              <input type="hidden" name="id" value="{{ $order->id }}" />
              <button class="btn btn-dark w-100">حفظ البيانات</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection