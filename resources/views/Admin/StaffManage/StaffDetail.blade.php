@extends("Admin.Layouts.Master")
@section('Title', 'Chi tiết Staff')
@section('Content')

<style type="text/css">
  @media only screen and (max-width: 900px) {
    td{
      white-space: nowrap;
    }

  }
  p{
    font-size: 85% !important;
  }
</style>
<div class="container-scroller">
  <x-admin.layouts.header-dashboard/>
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
    </div>
    <div class="sidebar sidebar-offcanvas">
      <x-admin.layouts.side-bar/>
    </div>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row bg-white p-3">
              
              <div class="col-12 col-md-3 col-xl-3 mb-4 mb-xl-0 pr-4 pl-0">
                <div class="bg-white shadow-sm w-100">
                  @if(isset($GetStaffs->image))
                  <img  src="{{ asset('images/staff')."/".$GetStaffs->image}}" style="object-fit: cover;" width="100%" height="100%">
                  @else
                  <img  src="{{ asset('images/staff/default.png')}}" style="object-fit: cover;" width="100%" height="100%">
                  @endif
                </div>
              </div>
              <div class="col-12 col-md-4 p-2">
                <h5 class="font-weight-bold tx">Chi tiết</h5>
                <p class=" mb-2">Họ và tên: {{$GetStaffs->full_name}}</p>
                <p class=" mb-2">Nickname: {{$GetStaffs->nick_name}}</p>
                <p class=" mb-2">Giới tính: @if($GetStaffs->sex == 0)Nam @else Nữ @endif</p>
                <p class=" mb-2">Ngày sinh: {{\Carbon\Carbon::parse($GetStaffs->date_of_birth)->format('d/m/Y')}}</p>
                <p class=" mb-2">Nơi sinh: {{$GetStaffs->place_of_birth}}</p>
                <p class=" mb-2">Điện thoại: <a href="tel:{{$GetStaffs->phone}}">{{$GetStaffs->phone}}</a></p>
                 <p class=" mb-2">Email: <a href="mailto:{{$GetStaffs->email}}">{{$GetStaffs->email}}</a></p>
                <p class=" mb-2">Tình trạng hôn nhân: @if($GetStaffs->marital_status == 0) Độc thân @else Đã kết hôn @endif</p>
                <p class=" mb-2">ID number: {{$GetStaffs->id_number}}</p>
                <p class=" mb-2">ngày hộ chiếu: {{\Carbon\Carbon::parse($GetStaffs->date_range)->format('d/m/Y')}}</p>
                <p class=" mb-2">Nơi ở: {{$GetStaffs->hometown}}</p>
                <p class=" mb-2">Quốc tịch: {{$GetStaffs->passport_issuer}}</p>
                <p class=" mb-2">Cơ quan cấp hộ chiếu: {{$GetStaffs->nationality}}</p>
                <p class=" mb-2">Quốc gia: {{$GetStaffs->nation}}</p>
                <p class=" mb-2">Tôn giáo: {{$GetStaffs->religion}}</p>  
              </div>
              <div class="col-12 col-md-5 p-2">
                 <p class=" mb-2">Hộ gia đình: {{$GetStaffs->permanent_residence}}</p>
                <p class=" mb-2">Ở lại: {{$GetStaffs->staying}}</p>
                <p class=" mb-2">Loại nhân viên: {{$GetStaffs->employee_types}}</p>
                <p class=" mb-2">Trình độ chuyên môn: {{$GetStaffs->levels}}</p>
                <p class=" mb-2">Trình độ học vấn: {{$GetStaffs->educationals  }}</p>
                <p class=" mb-2">Chuyên môn hóa: {{$GetStaffs->specializes}}</p>
                <p class=" mb-2">Phòng: {{$GetStaffs->rooms}}</p>
                <p class=" mb-2">Chức vụ: {{$GetStaffs->positions  }}</p>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>   
  </div>

  @endsection











