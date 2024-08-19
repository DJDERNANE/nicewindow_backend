@extends('layouts.admin.app')

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-6">
          <div class="home-card-statistics bg-white mb-4 shadow-sm">
            <div class="clearfix border-bottom">
              <h3 class="float-start p-3">
                <span>الزيارات</span>
                <br />
                300
              </h3>
              <ion-icon name="eye-outline" class="float-end px-3 pt-4 mt-3 h1"></ion-icon>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="home-card-statistics bg-white mb-4 shadow-sm">
            <div class="clearfix border-bottom">
              <h3 class="float-start p-3">
                <span>مستخدمين جدد</span>
                <br />
                98
              </h3>
              <ion-icon name="person-add-outline" class="float-end px-3 pt-4 mt-3 h1"></ion-icon>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <a href="{{ route('admin.orders.profile') }}" class="text-dark">
            <div class="home-card-statistics bg-white mb-4 shadow-sm">
              <div class="clearfix border-bottom">
                <h3 class="float-start p-3">
                  <span>طلبات من الناقلين</span>
                  <br />
                  4
                </h3>
                <ion-icon name="subway-outline" class="float-end px-3 pt-4 mt-3 h1"></ion-icon>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <div class="home-card-statistics bg-white mb-4 shadow-sm">
            <div class="clearfix border-bottom">
              <h3 class="float-start p-3">
                <span>طلبات للزبائن</span>
                <br />
                300
              </h3>
              <ion-icon name="logo-windows" class="float-end px-3 pt-4 mt-3 h1"></ion-icon>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="home-card-profile py-4 px-3 bg-white shadow-sm">
        <div class="home-card-profile-img rounded-pill border border-2 border-dark my-2">
          <img src="{{ !empty(Auth::user()->profile_photo_path) ? Auth::user()->profile_photo_path : asset('assets/admin/images/brand.png') }}" width="100%" height="100%" />
        </div>
        <div class="home-card-profile-name h5 text-center">
          {{ Auth::user()->firstname.' '.Auth::user()->lastname }}
        </div>
        <div class="home-card-profile-buttons text-center mt-3">
          <div class="row">
            <div class="col-6">
              <a href="{{ route('admin.profile') }}">
                <button class="btn btn-outline-info w-100">
                  <ion-icon name="person-outline"></ion-icon>
                  <span>حسابي</span>
                </button>
              </a>
            </div>
            <div class="col-6">
              <button class="btn btn-outline-danger w-100">
                <ion-icon name="log-out-outline"></ion-icon>
                <span>تسجيل الخروج</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection