@extends("Staff.Layouts.Master")
@section('Title', 'Change Password')
@section('Content')
<div class="container-scroller">
  <x-staff.layouts.header-dashboard/>
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
    </div>
    <div class="sidebar sidebar-offcanvas">
      <x-staff.layouts.side-bar/>
    </div>
    <div class="main-panel">
     <div class="content-wrapper">
        <div class="row m-0">
          <div class="col-md-12 grid-margin p-0">
            <div class="row m-0">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0 p-0">
                <div>
                  <div class="bg-white p-4">
                    <h4 class="mb-4">Đổi mật khẩu</h4>
                    <form method="post" action="{{url('change-password')}}">
                      @csrf
                      <div class="row m-0">
                        <div class="col-6 p-0 pr-2 mb-2">
                          <label class="fz95">Mật khẩu hiện tại</label>
                          <input type="password" name="passwordNow" class="form-control mr-2" required>
                        </div>
                        <div class="col-6 p-0 pl-2 mb-2">
                          <label class="fz95">Mật khẩu mới</label>
                          <input type="password" name="passwordNew" class="form-control mr-2" required>
                        </div>
                        <div class="col-6 p-0 pr-2 mb-2">
                          <label class="fz95">Nhập lại mật khẩu mới</label>
                          <input type="password" name="passwordNewRe" class="form-control mr-2" required>
                        </div>  
                        <div class="col-12 p-0  text-center">
                          @if (\Session::has('msg'))
                          <span class="text-success mt-2">{!! \Session::get('msg') !!}</span>
                          @endif
                        </div>
                        <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                          <button class="btn bg text-white">Đổi mật khẩu</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>   
  </div>
  @endsection








