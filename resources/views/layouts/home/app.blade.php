<!DOCTYPE html>
<html lang="ar" dir="rtl">
  @include('layouts.home.head')
  <body>
    <div class="hero_area">
      @include('layouts.home.header')

      @yield('content')

      @include('layouts.home.footer')
    </div>
  </body>
</html>