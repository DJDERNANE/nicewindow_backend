<!-- info section -->
<section class="info_section layout_padding-top">
  <div class="container layout_padding2">
    <div class="row">
      <div class="col-md-3">
        <h5>
          عنا
        </h5>
        <p>
          نسعى لرقمنة قطاع نجارة الألمنيوم بمنتجات برمجية متطورة تساعد كل الأطراف لضمان جودة منتج عالية و سرعة لتقديم الطلب.
        </p>
      </div>
      <div class="col-md-3">
        <h5>
          روابط مهمة
        </h5>
        <ul>
          <li>
            <a href="{{ route('home.privacy') }}">
              سياسة الخصوصية
            </a>
          </li>
          <li>
            <a href="{{ route('home') }}#contact">
              تواصل معنا
            </a>
          </li>
        </ul>
      </div>
      <div class="col-md-3">
        <h5>
          معلومات عنا
        </h5>
        <ul>
          <li>contact@nicewindow.tech</li>
          <li dir="ltr">+213 555 66 77 88</li>
        </ul>
      </div>
      <div class="col-md-3">
        <img src="{{ asset('assets/home/images/logo.png') }}" alt="" width="100%" />
      </div>
    </div>
  </div>
  <div class="container">
    <div class="social_container">
      <div class="social-box">
        <a href="#">
          <img src="{{ asset('assets/home/images/fb.png') }}" alt="" />
        </a>

        <a href="#">
          <img src="{{ asset('assets/home/images/twitter.png') }}" alt="" />
        </a>
        <a href="#">
          <img src="{{ asset('assets/home/images/linkedin.png') }}" alt="" />
        </a>
        <a href="#">
          <img src="{{ asset('assets/home/images/instagram.png') }}" alt="" />
        </a>
      </div>
    </div>
  </div>
</section>

<!-- end info section -->
<!-- footer section -->
<section class="container-fluid footer_section">
  <p>
    &copy; {{ Date('Y') }} All Rights Reserved. Powered by
    <a href="https://bliz.one" class="fw-bold">BLIZ</a>
  </p>
</section>
<!-- footer section -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  function openNav() {
    document.getElementById("myNav").classList.toggle("menu_width");
    document
      .querySelector(".custom_menu-btn")
      .classList.toggle("menu_btn-style");
  }
</script>