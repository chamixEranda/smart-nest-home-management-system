<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{translate('messages.admin')}} | {{translate('messages.login')}}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/css/styles.min.css') }}">
  <link rel="stylesheet" href="{{asset('assets/admin/css/theme.minc619.css?v=1.0')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/css/vendor.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/css/toastr.css')}}">
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="{{ route('admin.auth.login') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ asset('assets/img/logo.png') }}" width="180" alt="">
                </a>
                <p class="text-center">“Your Home, Your Rules, Our Tech”</p>
                <form action="{{route('admin.auth.submit')}}" method="post" id="form-id">
                  @csrf

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{ translate('messages.email') }}</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>

                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">{{ translate('messages.password') }}</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                  </div>

                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" name="remember" value="1" id="flexCheckChecked">
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        {{translate('messages.remember_me')}}
                      </label>
                    </div>
                    {{-- <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a> --}}
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2 text-uppercase">{{ translate('messages.sign_in') }}</button>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/admin/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{asset('assets/admin/js/vendor.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/theme.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/toastr.js')}}"></script>
  {!! Toastr::message() !!}
  @if ($errors->any())
    <script>
      @foreach($errors->all() as $error)
      toastr.error('{{$error}}', Error, {
        CloseButton: true,
        ProgressBar: true
      });
      @endforeach
    </script>
@endif
</body>
</html>