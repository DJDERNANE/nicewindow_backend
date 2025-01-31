@extends('layouts.home.app')

@section('content')
  <section class="slider_section position-relative" id="slide">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="detail-box">
            <h2 class="text-light">
              إدعم تجارتك مع
            </h2>
            <h1>
              nice window
            </h1>
            <div>
              <a href="#features">
                مزيد من المعلومات
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="img-box">
                  <img src="{{ asset('assets/home/images/slider-img.png') }}" alt="" width="100%" />
                </div>
              </div>
              <div class="carousel-item">
                <div class="img-box">
                  <img src="{{ asset('assets/home/images/slider-img.png') }}" alt="" width="100%" />
                </div>
              </div>
              <div class="carousel-item">
                <div class="img-box">
                  <img src="{{ asset('assets/home/images/slider-img.png') }}" alt="" width="100%" />
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev"></a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next"></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- feature section -->
  <section class="feature_section layout_padding2 layout_margin" id="features">
    <div class="container">
      <div class="heading_container">
        <h2>
          مميزات مذهلة تجدها <br />
          داخل التطبيق
        </h2>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="head-box">
              <div class="img-box">
                <svg height="512pt" viewBox="0 0 512 512.08926" width="512pt" xmlns="http://www.w3.org/2000/svg">
                  <path d="m383.808594 117.007812 11.316406-11.3125 11.3125 11.3125-11.3125 11.3125zm0 0" />
                  <path d="m146.390625 354.433594 112-112 11.3125 11.3125-112 112zm0 0" />
                  <path d="m32.042969 456.089844h176v16h-176zm0 0" />
                  <path d="m32.042969 424.089844h32v16h-32zm0 0" />
                  <path d="m80.042969 424.089844h32v16h-32zm0 0" />
                  <path d="m128.042969 424.089844h80v16h-80zm0 0" />
                  <path
                    d="m455.078125 170.191406c42.605469-42.335937 63.105469-102.078125 55.460937-161.652344l-.796874-6.179687-6.175782-.796875c-59.574218-7.621094-119.304687 12.886719-161.632812 55.496094l-28.945313 28.949218-50.910156-5.65625-76.257813 76.257813 39.601563 39.601563 33.933594-33.945313 11.601562 11.601563-34.222656 34.222656h-204.691406c-17.671875 0-32.0000002 14.328125-32.0000002 32v240c0 17.671875 14.3281252 32 32.0000002 32h352c17.675781 0 32-14.328125 32-32v-214.296875l15.738281-15.734375-5.65625-50.90625zm40.253906-153.398437c2.945313 31.992187-2.863281 64.183593-16.800781 93.128906l-76.320312-76.328125c28.949218-13.929688 61.132812-19.734375 93.121093-16.800781zm-247.289062 134.160156-22.621094 22.632813-16.976563-16.976563 59.503907-59.511719 30.550781 3.398438-27.679688 27.671875zm34.226562 34.222656 16.6875 16.691407-22.632812 22.621093 11.3125 11.3125 22.632812-22.625 16.6875 16.691407-66.632812 66.621093 11.3125 11.3125 66.632812-66.625 11.597657 11.601563-33.941407 33.945312 39.597657 39.589844 12.519531-12.527344v70.304688h-320v-128h140.691406l-16.410156 16.398437 11.3125 11.3125zm117.773438 294.914063c0 8.835937-7.160157 16-16 16h-352c-8.835938 0-16-7.164063-16-16v-240c0-8.835938 7.164062-16 16-16h188.691406l-16 16h-172.691406v160h352v-102.296875l16-16zm-44.519531-176.402344-16.976563-16.964844 22.632813-22.632812 50.449218-50.457032 3.390625 30.550782zm5.65625-62.230469-39.597657-39.589843 33.941407-33.945313-11.3125-11.3125-33.941407 33.9375-39.601562-39.59375 82.578125-82.582031c10.304687-10.296875 21.828125-19.296875 34.308594-26.808594l83.019531 83.015625c-7.515625 12.476563-16.515625 23.996094-26.808594 34.304687zm0 0" />
                  <path d="m186.382812 66.429688 64.003907-64 11.3125 11.3125-64.003907 64zm0 0" />
                  <path d="m122.382812 66.429688 48-47.996094 11.3125 11.3125-48 48zm0 0" />
                  <path d="m434.386719 314.429688 64.003906-64 11.3125 11.3125-64 64zm0 0" />
                  <path d="m434.386719 378.429688 47.996093-47.996094 11.316407 11.3125-48 48zm0 0" />
                  <path d="m138.386719 306.429688 22.628906-22.625 11.3125 11.3125-22.628906 22.628906zm0 0" />
                  <path d="m226.390625 330.429688 22.628906-22.625 11.3125 11.3125-22.628906 22.628906zm0 0" />
                  <path d="m232.042969 480.089844h136v-64h-136zm88-48h32v32h-32zm-72 0h56v32h-56zm0 0" />
                </svg>

              </div>
              <h6>
                واجهة سهلة الإستخدام
              </h6>
            </div>
            <div class="detail-box">
              <p>
                ركزنا على تصميم تطبيق سهل ليتمكن الجميع من إستخدامه بدون أي مشاكل.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="head-box">
              <div class="img-box">
                <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="m507.606 155.023-150.632-150.629c-2.813-2.814-6.628-4.394-10.606-4.394s-7.794 1.58-10.607 4.394l-56.4 56.398c-2.813 2.813-4.394 6.628-4.394 10.606 0 3.979 1.581 7.794 4.394 10.607l13.841 13.84c-33.74 29.925-72.881 47.928-116.557 53.559-36.544 4.712-62.791-1.46-63.013-1.515-7.85-1.938-15.823 2.692-18.028 10.47l-94.348 332.638c-2.421 5.543-1.342 12.235 3.236 16.719 2.919 2.859 6.709 4.284 10.496 4.284 2.481 0 4.957-.618 7.19-1.838l331.451-93.773c7.783-2.202 12.419-10.179 10.479-18.031-.243-.984-22.395-95.369 52.059-179.552l13.827 13.827c2.929 2.93 6.767 4.394 10.607 4.394 3.838 0 7.678-1.465 10.607-4.394l56.4-56.397c2.813-2.813 4.394-6.628 4.394-10.606s-1.582-7.795-4.396-10.607zm-174.946 177.892c-3.06 24.854-1.76 45.431-.144 58.27l-266.826 75.489 118.383-120.861c9.316 5.464 19.949 8.387 31.035 8.387 16.43 0 31.877-6.397 43.495-18.016h.001c23.982-23.982 23.982-63.005-.001-86.987s-63.006-23.982-86.989 0c-20.481 20.481-23.457 51.923-8.956 75.607l-116.943 119.39 75.082-264.715c12.839 1.616 33.42 2.919 58.28-.143 35.648-4.389 86.991-18.911 135.359-62.257l80.483 80.481c-43.346 48.366-57.869 99.708-62.259 135.355zm-139.834-62.506c6.144-6.144 14.211-9.214 22.281-9.214 8.068 0 16.139 3.072 22.281 9.214 12.286 12.286 12.286 32.275 0 44.561-5.952 5.951-13.864 9.228-22.281 9.228s-16.329-3.277-22.281-9.228c-12.285-12.285-12.285-32.275 0-44.561zm247.774-69.595-14.155-14.154c-.002-.002-.003-.003-.004-.005-.002-.002-.003-.003-.005-.005l-115.254-115.252 35.186-35.185 129.418 129.416z" />
                </svg>
              </div>
              <h6>
                تصميم الطلبات
              </h6>
            </div>
            <div class="detail-box">
              <p>
                يمكنك من خلال التطبيق تصميم طلباتك بمختلف أنواعها كالنوافذ و الأبواب وحساب السعر بسهولة وبمميزات متنوعة
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="head-box">
              <div class="img-box">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                  style="enable-background:new 0 0 512 512;" xml:space="preserve">
                  <g>
                    <g>
                      <g>
                        <path d="M294,198H60c-33.084,0-60,26.916-60,60v154c0,33.084,26.916,60,60,60h234c33.084,0,60-26.916,60-60V258
                    C354,224.916,327.084,198,294,198z M314,412c0,11.028-8.972,20-20,20H60c-11.028,0-20-8.972-20-20V258c0-11.028,8.972-20,20-20
                    h234c11.028,0,20,8.972,20,20V412z" />
                        <rect y="120" width="40" height="40" />
                        <path d="M40,40C17.909,40,0,57.909,0,80h40V40z" />
                        <rect x="236" y="40" width="40" height="40" />
                        <rect x="158" y="40" width="40" height="40" />
                        <rect x="79" y="40" width="40" height="40" />
                        <path d="M472,40v40h40C512,57.909,494.091,40,472,40z" />
                        <rect x="472" y="354" width="40" height="40" />
                        <rect x="472" y="276" width="40" height="40" />
                        <rect x="472" y="198" width="40" height="40" />
                        <rect x="314" y="40" width="40" height="40" />
                        <rect x="472" y="120" width="40" height="40" />
                        <rect x="393" y="432" width="40" height="40" />
                        <path d="M472,472c22.091,0,40-17.909,40-40h-40V472z" />
                        <rect x="393" y="40" width="40" height="40" />
                      </g>
                    </g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                </svg>

              </div>
              <h6>
                إنشاء الفواتير
              </h6>
            </div>
            <div class="detail-box">
              <p>
                يمكنك كنجار من خلال التطبيق وبعد تصميم العمل المطلوب طباعة فاتورة تحتوي كامل تفاصيل الطلب بسهولة.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end feature section -->

  <!-- download section -->
  <section class="download_section layout_padding-bottom" id="steps">
    <div class="container">
      <div class="heading_container">
        <h2>
          متوفر على مختلف المنصات
        </h2>
      </div>
      <div class="pt-5">
        <div class="row">
          <div class="col-md-4">
            <div class="box">
              <div class="head-box">
                <div class="img-box">
                  01
                </div>
                <h6>
                  حمل التطبيق
                </h6>
              </div>
              <div class="detail-box">
                <p>
                  قم بتحميل التطبيق من خلال الضغط على الزر في الأسفل حسب نوع جهازك
                </p>
              </div>
            </div>
            <div class="box">
              <div class="head-box">
                <div class="img-box">
                  02
                </div>
                <h6>
                  قم بفتح حساب
                </h6>
              </div>
              <div class="detail-box">
                <p>
                  بمجرد دخولك للتطبيق يمكنك فتح حساب جديد لك.
                </p>
              </div>
            </div>
            <div>
              <a href="" class="btn-1">
                تحميل للأندرويد
              </a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="main-img-box">
              <img src="{{ asset('assets/home/images/download-img.png') }}" alt="" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="box">
              <div class="head-box">
                <div class="img-box">
                  03
                </div>
                <h6>
                  قمت بضبط الإعدادات
                </h6>
              </div>
              <div class="detail-box">
                <p>
                  بعد فتح حساب، يجب ضبط بعض الإعدادات كإضافة السلع المتوفرة لديك، أماكن محلاتك..
                </p>
              </div>
            </div>
            <div class="box">
              <div class="head-box">
                <div class="img-box">
                  04
                </div>
                <h6>
                  إستمتع بعملك
                </h6>
              </div>
              <div class="detail-box">
                <p>
                  تجربة إستخدام سهلة لتجعلك مستمتعا بعملك.
                </p>
              </div>
            </div>
            <div>
              <a href="" class="btn-2">
                تحميل للآيفون
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end download section -->

  <!-- about section -->
  <section class="about_section layout_padding" id="about">
    <div class="container">
      <div class="heading_container d-flex justify-content-lg-start">
        <h2>
          عن التطبيق
        </h2>
      </div>
      <div class="mt-5">
        <div class="detail-box b-2">
          <p>
            
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->


  <!-- contact section -->
  <section class="contact_section layout_padding" id="contact">
    <div class="container">
      <div class="d-flex">
        <h2>
          تواصل معنا
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('home.contactus.store') }}" method="POST" id="form-contactus-section">
            @csrf
            <div class="contact_form-container">
              <div>
                <div>
                  <input name="fullname" type="text" placeholder="الإسم الكامل" />
                </div>
                <div>
                  <input name="subject" type="text" placeholder="سبب التواصل" />
                </div>
                <div>
                  <input name="phone_number" type="text" placeholder="رقم الهاتف" />
                </div>
                <div>
                  <input name="email" type="email" placeholder="البريد الإلكتروني" />
                </div>
                <div class="mt-4">
                  <textarea name="message" type="text" placeholder="الرسالة"></textarea>
                </div>
                <div class="mt-5">
                  <button type="submit">إرسال</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <div class="contact_img-box">
            <img src="{{ asset('assets/home/images/contact-img.png') }}" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection