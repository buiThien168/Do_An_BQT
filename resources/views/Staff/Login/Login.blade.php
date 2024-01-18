@extends("Staff.Layouts.Master")
@section('Title', 'Login')
@section('Content')
<div class="container-fluid p-0">
  <div class="row m-0">
    <div class="col-8 p-5 bg text-white">
      <p class="text-center font-weight-bold mt-0 mb-5" style="font-size: 180%;">Building a work management and administration system</p>
      <div class="row m-0">
        <div class="col-6 p-0">
          <p class="font-weight-bold mt-4" style="font-size: 130%;">ADMIN</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Information manage</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Employee manager</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>HRM</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Workflow management</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Salary and discipline management</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Time attendance management</p>
          <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Send email, notification letter</p>
        </div>
        <div class="col-6 p-0">
         <p class="font-weight-bold mt-4" style="font-size: 130%;">STAFF</p>
         <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Information manage</p>
         <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Workflow management</p>
         <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Salary and discipline management</p>
         <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Time attendance - Face recognition</p>
         <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Identity data management</p>
         <p class="font-weight-bold mt-4" style="font-size: 130%;"><i class="fa fa-check mr-3" aria-hidden="true"></i>Face registration</p>
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
</div>
<script src="{{ asset('index/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('index/js/validate/jquery.validate.min.js') }}" ></script>
<script src="{{ asset('index/js/validate/validate.js') }}"></script>
@endsection








