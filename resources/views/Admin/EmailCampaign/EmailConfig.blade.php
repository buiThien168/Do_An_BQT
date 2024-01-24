@extends("Admin.Layouts.Master")
@section('Title', 'Change configuration email')
@section('Content')
<div class="container-scroller">
  <x-admin.layouts.header-dashboard/>
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
    </div>
    <div class="side-bar-box" style="width: 250px;">
      <x-admin.layouts.side-bar/>
    </div>
    <div class="main-panel">
      <div class="content-wrapper px-0 py-3">
        <div class="row m-0">
          <div class="col-md-12 grid-margin p-0">
            <div class="row m-0">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0 p-0">
                <div>
                  <div class="bg-white p-4">
                    <h4 class="mb-4">Thay đổi email cấu hình</h4>
                    <form method="post" action="{{url('admin/email-marketing/email-config')}}">
                      @csrf
                      <div class="row m-0">
                        <div class="col-12 p-0 mb-2">
                          <label class="fz95">Máy chủ email</label>
                          <input type="text" name="mail_host" class="form-control mr-2" value="{{$getEmailConfig->mail_host ?? ''}}" required>
                        </div>
                        <div class="col-12 p-0 mb-2">
                          <label class="fz95">Cổng</label>
                          <input type="text" name="mail_port" class="form-control mr-2"  value="{{$getEmailConfig->mail_port ?? ''}}" required>
                        </div>
                        <div class="col-12 p-0 mb-2">
                          <label class="fz95">Email</label>
                          <input type="text" name="mail_username" class="form-control mr-2" required  value="{{$getEmailConfig->mail_username ?? ''}}">
                        </div> 
                        <div class="col-12 p-0 mb-2">
                          <label class="fz95">Mật khẩu (tên miền) / mật khẩu ứng dụng (gmail)</label>
                          <input type="text" name="mail_password" class="form-control mr-2" required  value="{{$getEmailConfig->mail_password ?? ''}}">
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








