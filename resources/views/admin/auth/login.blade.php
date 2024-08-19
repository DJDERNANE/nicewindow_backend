<!DOCTYPE html>
<html dir="rtl">
  <head>
    <meta charset="utf-8" />
    <title>NICE WINDOW | Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="BLIZ ONE" />
    <link href="{{ asset('assets/admin/images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon" />
    <!-- bootstrap core css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/styles.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-4 offset-md-4">
          <div class="login-logo text-center mb-3">
            <img src="{{ asset('assets/admin/images/logo.png') }}" width="200px" />
          </div>
          <form action="{{ route('admin.auth.login') }}" method="get">
            @csrf
            <div class="login-card bg-white p-3 shadow-sm">
              <h4 class="text-center">تسجيل الدخول</h4>
              <div class="mb-3">
                <label class="form-label">البريد الإلكتروني: </label>
                <input type="email" name="email" class="form-control border-2" />
              </div>
              <div class="mb-3">
                <label class="form-label">كلمة المرور: </label>
                <input type="password" name="password" class="form-control border-2" />
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-6">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">تذكرني.</label>
                    </div>
                  </div>
                  <div class="col-6 text-end">
                    <a href="#" class="text-danger">نسيت كلمة المرور؟</a>
                  </div>
                </div>
              </div>
              <div class="mb-3 d-grid gap-2">
                <button type="submit" class="btn btn-dark border-2">دخول</button>
              </div>
    
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
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/app.js') }}"></script>
  </body>
</html>