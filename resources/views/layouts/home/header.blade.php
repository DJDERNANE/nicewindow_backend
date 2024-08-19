<!-- header section strats -->
<header class="header_section">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand" href="{{ route('home') }}">
        <span>
          <img src="{{ asset('assets/home/images/logo.png') }}" alt="" />
        </span>
      </a>

      <div class="navbar-collapse" id="">
        <div class="custom_menu-btn">
          <button onclick="openNav()">
            <span class="s-1"> </span>
            <span class="s-2"> </span>
            <span class="s-3"> </span>
          </button>
        </div>
        <div id="myNav" class="overlay">
          <div class="overlay-content">
            <a href="#slide">الرئيسية</a>
            <a href="#about">عن الشركة</a>
            <a href="#features">المميزات</a>
            <a href="#pricing">الأسعار</a>
            <a href="#contact">تواصل معنا</a>
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>
<!-- end header section -->