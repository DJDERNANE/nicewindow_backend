@extends('layouts.admin.app')

@section('content')
  <h2>طلبات من الناقلين</h2>
  <div class="card">
    <div class="card-body">
      <table class="table-one">
        <thead>
          <tr>
            <th>#</th>
            <th>النجار</th>
            <th>الناقل</th>
            <th>العنوان</th>
            <th>السعر</th>
            <th>الحالة</th>
            <th>التاريخ</th>
            <th>خيارات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td class="{{ $order->carpentry->deleted_at ? 'text-danger' : '' }}">{{ $order->carpentry->firstname.' '.$order->carpentry->lastname }}</td>
              <td class="{{ $order->supplier->deleted_at ? 'text-danger' : '' }}">{{ $order->supplier->firstname.' '.$order->supplier->lastname }}</td>
              <td>{{ $order->shipping_address }}</td>
              <td>{{ $order->total_price }} د.ج</td>
              <td>
                @if ($order->status === 1)
                  <span class="text-warning">قيد التوصيل</span>
                @elseif($order->status === 2)
                  <span class="text-success">منتهية</span>
                @elseif($order->status === 3)
                  <span class="text-danger">ملغية</span>
                @else
                  <span class="text-primary">قيد الإنتظار</span>
                @endif
              </td>
              <td>{{ $order->created_at }}</td>
              <td>
                <a href="{{ route('admin.order.profile', ['order' => $order->id]) }}">
                  <button class="btn btn-success btn-xs">
                    <ion-icon name="document-outline"></ion-icon>
                  </button>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @if ($orders && count($orders) > 0)
      <div class="card-footer">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?= $orders->previousPageUrl() ? '<li class="page-item"><a class="page-link" href="'.$orders->previousPageUrl().'"> '.($orders->currentPage()-1).' </a></li>' : '' ?>
            <li class="page-item disabled"><a class="page-link" href="{{ $orders->url($orders->currentPage()) }}"> {{ $orders->currentPage() }} </a></li>
            <?= $orders->nextPageUrl() ? '<li class="page-item"><a class="page-link" href="'.$orders->nextPageUrl().'"> '.($orders->currentPage()+1).' </a></li>' : '' ?>
          </ul>
        </nav>
      </div>
    @endif
  </div>
@endsection