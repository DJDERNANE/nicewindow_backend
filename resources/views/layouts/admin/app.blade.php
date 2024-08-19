<!DOCTYPE html>
<html dir="rtl">
  @include('layouts.admin.head')
  <body>

    <div class="all">
      @include('layouts.admin.sidebar')
      <div class="admin-body" id="admin-body">
        @include('layouts.admin.header')
        <div class="clearfix"></div>
        
        <div class="admin-content mt-2">
          <div class="container-fluid">
            @yield('content')
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/app.js') }}"></script>

    @yield('scripts')
  </body>
</html>