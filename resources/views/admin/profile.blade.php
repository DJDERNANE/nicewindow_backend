@extends('layouts.admin.app')

@section('content')
  <h2 class="mb-3">حسابي</h2>
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

  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h4>إعدادات عامة</h4>
          <form action="{{ route('admin.profile.settings.general.update') }}" method="post">
            @csrf
            <div class="mb-3">
              <label class="form-label">الإسم: </label>
              <input type="text" name="firstname" class="form-control border-2" value="{{ Auth::user()->firstname }}" required />
            </div>
            <div class="mb-3">
              <label class="form-label">اللقب: </label>
              <input type="text" name="lastname" class="form-control border-2" value="{{ Auth::user()->lastname }}" required />
            </div>
            <div class="mb-3">
              <label class="form-label">البريد الإلكتروني: </label>
              <input type="email" name="email" class="form-control border-2" value="{{ Auth::user()->email }}" required />
            </div>
            <div class="mb-3">
              <label class="form-label">رقم الهاتف: </label>
              <input type="text" name="phone_number" class="form-control border-2" value="{{ Auth::user()->phone_number }}" required />
            </div>
            <div class="mb-3">
              <button class="btn btn-dark w-100">حفظ</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <div class="box">
            <form action="{{ route('admin.profile.settings.profile_picture.update') }}" method="post" enctype="multipart/form-data">
              @csrf
              <label class="form-label">الصورة الشخصية: </label>
              <div class="account-img-selection border border-dark" style="background-color: #ddd;cursor: pointer;" onclick="$('#pimage').click();">
                <img src="{{ !empty(Auth::user()->profile_photo_path) ? Auth::user()->profile_photo_path : asset('assets/admin/images/brand.png') }}" id="pimageView" width="100%" />
                <ion-icon name="camera-outline"></ion-icon>
              </div>
              <input type="file" name="image" id="pimage" class="d-none" onchange="readURL(this, '#pimageView'); $('#pimageView').show();$('#uppSubmit').show();" accept="image/*" />
              <button type="submit" class="btn btn-dark w-100 mt-3" id="uppSubmit" style="display:none;">حفظ</button>
            </form>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h4>إعدادات الحماية</h4>
          <form action="{{ route('admin.profile.settings.security.update') }}" method="post">
            @csrf
            <div class="mb-3">
              <label class="form-label">كلمة المرور الحالية: </label>
              <input type="password" name="current_password" class="form-control border-2" required />
            </div>
            <div class="mb-3">
              <label class="form-label">كلمة المرور الجديدة: </label>
              <input type="password" name="new_password" class="form-control border-2" required />
            </div>
            <div class="mb-3">
              <label class="form-label">تأكيد كلمة المرور الجديدة: </label>
              <input type="password" name="confirm_new_password" class="form-control border-2" required />
            </div>
            <div class="mb-3">
              <button class="btn btn-danger w-100">حفظ</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection