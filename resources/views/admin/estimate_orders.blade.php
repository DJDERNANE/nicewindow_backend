@extends('layouts.admin.app')

@section('content')
  <h2>طلبات من النجارين</h2>
  <div class="card">
    <div class="card-body">
      <table class="table-one">
        <thead>
          <tr>
            <th>#</th>
            <th>النجار</th>
            <th>الزبون</th>
            <th>السعر الإجمالي</th>
            <th>التاريخ</th>
            <th>خيارات</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>{{ $order->carpentry->firstname.' '.$order->carpentry->lastname }}</td>
              <td>{{ $order->client->name }}</td>
              <td>{{ $order->total_price }}</td>
              <td>{{ $order->created_at }}</td>
              <td>
                <button class="btn btn-xs btn-success">
                  
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" align="center">لا توجد بيانات</td>
            </tr>
          @endforelse
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