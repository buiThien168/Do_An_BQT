@extends("Staff.Layouts.Master")
@section('Title', 'Account information')
@section('Content')
<div class="container-scroller">
  <x-staff.layouts.header-dashboard />
  <div class="container-fluid page-body-wrapper">
    {{-- <div class="theme-setting-wrapper">
      <div id="settings-trigger"><i class="ti-settings"></i></div>
      <div id="theme-settings" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options ">
          <div class="img-ss rounded-circle  border mr-3"></div><a class="text-black" href="{{url('/attendance')}}">Điểm danh</a>
        </div>
        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
          <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
          <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
          <div class="tiles success"></div>
          <div class="tiles warning"></div>
          <div class="tiles danger"></div>
          <div class="tiles info"></div>
          <div class="tiles dark"></div>
          <div class="tiles default"></div>
        </div>
      </div>
    </div> --}}
    <x-staff.layouts.setting />
    <div class="sidebar sidebar-offcanvas">
      <x-staff.layouts.side-bar />
    </div>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row m-0">
          <div class="col-md-12 grid-margin p-0">
            <div class="row m-0">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0 p-0">
                <div>
                  <div class="bg-white p-4">
                    <h4 class="mb-4">Thông tin tài khoản</h4>
                    <form method="post" action="{{url('account-information/edit')}}">
                      @csrf
                      <div class="row m-0">
                        <div class="col-6 p-0 pl-2 mb-2 px-2">
                          <label class="fz95">Họ và tên</label>
                          <input type="text" value="{{$getInfo->full_name}}" name="phone" class="form-control mr-2" disabled>
                        </div>
                        <div class="col-6 p-0 pr-2 mb-2 px-2">
                          <label class="fz95">E-mail</label>
                          <input type="text" value="{{$getInfo->email}}" name="email" class="form-control mr-2"
                            required>
                        </div>
                        <div class="col-6 p-0 pl-2 mb-2 px-2">
                          <label class="fz95">Điện thoại</label>
                          <input type="text" value="{{$getInfo->phone}}" name="phone" class="form-control mr-2"
                            disabled>
                        </div>
                        <div class="col-12 p-0  text-center">
                          @if (\Session::has('msg'))
                          <span class="text-success mt-2">{!! \Session::get('msg') !!}</span>
                          @endif
                        </div>
                        <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                          <button class="btn bg text-white">Thay đổi</button>
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