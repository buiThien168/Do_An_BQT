@extends("Staff.Layouts.Master")
@section('Title', 'Login')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
  integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/logins/login.css')}}">
@section('Content')
<div id="alertSus" class="alert alert-warning" style="position: absolute;top: 8px;right: 12px;" hidden>
  <strong>Cảnh báo!</strong> Vui lòng liên hệ admin để được cấp lại mật khẩu!.
</div>
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
              <small><a href="" onclick="handelSus()">Forgot Password?</a></small>
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

@endsection

<script>
  function handelSus(){
    let alertSus = document.getElementById("alertSus");
    if (alertSus) {
      alertSus.removeAttribute("hidden");
  }
}
</script>