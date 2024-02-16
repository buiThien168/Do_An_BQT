@extends("Staff.Layouts.Master")
@section('Title', 'Login')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
  integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/logins/login.css')}}">
@section('Content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="row border rounded-5 p-3 bg-white shadow box-area">
    <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
      style="background: #103cbe;">
      <div class="featured-image mb-3">
        <img src="{{asset('logo/login.png')}}" class="img-fluid" style="width: 250px;">
      </div>
      <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">HachiTech
      </p>
      <small class="text-white text-wrap text-center"
        style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on this
        platform.</small>
    </div>

    <div class="col-md-6 right-box">
      <div class="row align-items-center">
        <form action="{{url('/')}}" method="post" id="login-user-form">
          @csrf
          <div class="header-text mb-4">
            <h2>Login</h2>
            <p>We are happy to have you back.</p>
          </div>
          <div class="input-group mb-3">
            <input type="number" name="phone" class="form-control form-control-lg bg-light fs-6"
              placeholder="Enter phone number" required>
          </div>
          <div class="input-group mb-1">
            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6"
              placeholder="Password" required>
          </div>
          <div class="input-group mb-5 d-flex justify-content-between">
            <div class="forgot">
              <small><a href="#">Forgot Password?</a></small>
            </div>
          </div>
          <div class="input-group mb-3">
            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Log in</button>
            @if (\Session::has('msg'))
            <p class="text-danger mt-2 text-center mb-0 fz-95">{!! \Session::get('msg') !!}</p>
            @endif
          </div>
          <div class="row">
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
{{-- <div class="container-fluid p-0">
  <div class="row m-0">
    <div class="col-8 p-5 bg text-white">
      <p class="text-center font-weight-bold mt-0 mb-5" style="font-size: 180%;">Xây dựng hệ thống quản lý và điều hành
        công việc</p>
      <div class="row m-0">
        <div class="col-6 p-0">
          <p class="font-weight-bold mt-4" style="font-size: 130%;">ADMIN</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Quản lý thông tin</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Người lao động manager</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>HRM</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Quản lý công việc</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Quản lý tiền lương và kỷ luật</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Quản lý chấm công</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Gửi email, thư thông báo</p>
        </div>
        <div class="col-6 p-0">
          <p class="font-weight-bold mt-4" style="font-size: 130%;">STAFF</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Quản lý thông tin</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Quản lý công việc</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Quản lý tiền lương và kỷ luật</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Chấm công - Nhận dạng khuôn mặt</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Quản lý dữ liệu nhận dạng</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3"
              aria-hidden="true"></i>Đăng ký khuôn mặt</p>
        </div>
      </div>



    </div>
    <div class="col-4 p-5">
      <div style="height: calc(100vh - 100px)">
        <form id="login-user-form" class="pt-5" action="{{url('/')}}" method="post">
          @csrf
          <p class="text-center font-weight-bold mt-1 tx" style="font-size: 110%">LOGIN</p>
          <hr>
          <p class="fz95 mb-1">Phone</p>
          <input type="number" name="phone" class="form-control w-100" required>

          <p class="fz95 mt-2 mb-1">Password</p>
          <input type="password" name="password" class="form-control w-100" required>

          <p class="float-right fz95 mt-2 tx cs">Forgot password</p>
          <button type="submit" class="btn bg w-100 text-white cs">Log in</button>
          @if (\Session::has('msg'))
          <p class="text-danger mt-2 text-center mb-0 fz-95">{!! \Session::get('msg') !!}</p>
          @endif

        </form>
      </div>
    </div>
  </div>
</div> --}}
{{-- <script src="{{ asset('index/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('index/js/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('index/js/validate/validate.js') }}"></script> --}}
@endsection