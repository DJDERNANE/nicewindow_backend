@extends('layouts.admin.app')

@section('content')
  <h2>المستخدمين</h2>
  <div class="card">
    <div class="card-body">
      <table class="table-one">
        <thead>
          <tr>
            <th>#</th>
            <th>الإسم الكامل</th>
            <th>البريد الإلكتروني</th>
            <th>رقم الهاتف</th>
            <th>إعدادات</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->firstname.' '.$user->lastname }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->phone_number }}</td>
              <td>
                <a href="{{ route('admin.user', ['user' => $user->id]) }}">
                  <button class="btn btn-success btn-xs">
                    <ion-icon name="person-outline"></ion-icon>
                  </button>
                </a>
                <button class="btn btn-danger btn-xs">
                  <ion-icon name="trash-outline"></ion-icon>
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" align="center">لا توجد بيانات</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if ($users && count($users) > 0)
      <div class="card-footer">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?= $users->previousPageUrl() ? '<li class="page-item"><a class="page-link" href="'.$users->previousPageUrl().'"> '.($users->currentPage()-1).' </a></li>' : '' ?>
            <li class="page-item disabled"><a class="page-link" href="{{ $users->url($users->currentPage()) }}"> {{ $users->currentPage() }} </a></li>
            <?= $users->nextPageUrl() ? '<li class="page-item"><a class="page-link" href="'.$users->nextPageUrl().'"> '.($users->currentPage()+1).' </a></li>' : '' ?>
          </ul>
        </nav>
      </div>
    @endif
  </div>
@endsection