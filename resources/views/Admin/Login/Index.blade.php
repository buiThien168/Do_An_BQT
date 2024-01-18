@extends("Admin.Layouts.Master")
@section('Title', 'Đăng nhập Admin')
@section('Content')

<link rel="stylesheet" href="{{ asset('index/css/reponsive.css') }}">
@include('Admin.Layouts.Header')
<div class="box-content d-flex" style="padding-top: 60px;width: 80%;margin: auto;">
  <div class="form-login-box bg-white mt-4 p-3" style="width: 30%;margin: auto;">
    <form id="login-admin-form" action="{{url('admin/login')}}" method="post">
      @csrf
      <p class="text-center font-weight-bold mt-1 tx" style="font-size: 110%">ADMIN</p>
      <hr>
      <p class="fz95 mb-0">Username</p>
      <input type="text" name="name" class="form-control w-100" required>
      <p class="fz95 mt-2 mb-0">Password</pl>
      <input type="password" name="password" class="form-control w-100" required>
      <button type="submit" class="btn bg w-100 text-white cs mt-4">Login</button>
      @if (\Session::has('msg'))
      <p class="text-danger mt-2 text-center mb-0 fz-95">{!! \Session::get('msg') !!}</p>
      @endif
   </form>
 </div>
</div>
<script src="{{ asset('index/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('index/js/validate/jquery.validate.min.js') }}" ></script>
<script src="{{ asset('index/js/validate/validate.js') }}"></script>
@endsection
