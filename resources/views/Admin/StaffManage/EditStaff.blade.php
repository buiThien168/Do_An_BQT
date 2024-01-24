@extends("Admin.Layouts.Master")
@section('Title', 'Edit Staff')
@section('Content')
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
        <div class="row m-0">
          <div class="col-md-12 grid-margin p-0">
            <div class="row m-0">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0 p-0">
                <div>
                  <div class="bg-white p-2">
                   <h5 class="card-title mb-4 font-weight-bold ml-2 mt-2 tx">Chỉnh sửa nhân viên</h5>
                   <form id="form-edit-steff" method="post" action="{{url('admin/user-management/edit')."/".$id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-0">
                      <div class="col-12 px-2">
                        <p class="font-weight-bold">| Thông tin cá nhân</p>
                      </div>
                      
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Nickname</label>
                        <input type="text" name="nick_name" class="form-control mr-2" value="{{$getStaff->nick_name}}" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Hình ảnh</label>
                        <input type="file" name="image" class="form-control mr-2">
                      </div>

                      <div class="col-12 px-2 mt-3">
                        <p class="font-weight-bold">| Thông tin liên hệ & đăng nhập</p>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Điện thoại</label>
                        <input type="number" name="phone" value="{{$getStaff->user->phone}}" class="form-control mr-2" autocomplete="off" >
                      </div>    
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Email</label>
                        <input type="text" name="email" value="{{$getStaff->email}}" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Password</label>
                        <input type="password" name="password" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 px-2 mt-3">
                        <p class="font-weight-bold">|Sơ yếu lý lịch</p>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Giới tính</label>
                        <select name="sex" class="form-control" id="exampleFormControlSelect1">
                          <option value="0" {{ $getStaff->sex == 0 ? 'selected' : '' }}>Nam</option>
                          <option value="1" {{ $getStaff->sex == 1 ? 'selected' : '' }}>Nữ</option>
                        </select>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày sinh</label>
                        <input type="date" value="{{\Carbon\Carbon::parse($getStaff->date_of_birth)->setTimezone('America/Los_Angeles')->format('Y-m-d')}}" name="date_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Nơi sinh</label>
                        <input type="text" value="{{$getStaff->place_of_birth}}" name="place_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Tình trạng hôn nhân</label>
                        <select name="marital_status" class="form-control" id="exampleFormControlSelect1">
                          <option value="0" {{ $getStaff->marital_status == 0 ? 'selected' : '' }}>Đã kết hôn</option>
                          <option value="1" {{ $getStaff->marital_status == 1 ? 'selected' : '' }}>Chưa kết hôn</option> 
                        </select>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">ID number</label>
                        <input type="text" value="{{$getStaff->id_number}}" name="id_number" class="form-control mr-2" autocomplete="off" >
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">ngày hộ chiếu</label>
                        <input type="date" value="{{\Carbon\Carbon::parse($getStaff->date_range)->setTimezone('America/Los_Angeles')->format('Y-m-d')}}" name="date_range" class="form-control mr-2" autocomplete="off" >
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Cơ quan cấp hộ chiếu</label>
                        <input type="text" name="passport_issuer" value="{{$getStaff->passport_issuer}}" class="form-control mr-2" autocomplete="off" >
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Nơi ở</label>
                        <input type="text" name="hometown" value="{{$getStaff->hometown}}" class="form-control mr-2" autocomplete="off" >
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Quốc tịch</label>
                        <input type="text" name="nationality" value="{{$getStaff->nationality}}" class="form-control mr-2" autocomplete="off" >
                      </div>  

                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Quốc gia</label>
                        <input type="text" name="nation" value="{{$getStaff->nation}}" class="form-control mr-2" autocomplete="off" >
                      </div>  
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Tôn giáo</label>
                        <input type="text" name="religion" value="{{$getStaff->religion}}" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Hộ gia đình</label>
                        <input type="text" name="permanent_residence" class="form-control mr-2" value="{{$getStaff->permanent_residence}}" autocomplete="off" >
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ở lại</label>
                        <input type="text" name="staying" class="form-control mr-2" value="{{$getStaff->staying}}" autocomplete="off" >
                      </div> 
                      <div class="col-12 px-2 mt-3">
                        <p class="font-weight-bold">| Thông tin việc làm</p>
                      </div>  
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Loại nhân viên</label>
                        <select name="employee_type" class="form-control" id="exampleFormControlSelect1">
                          @foreach($employee_type as $item)
                         <option  value="{{ $item->id }}" {{ $item->id == $getStaff->employee_type ? 'selected' : '' }}>{{ $item->name }}</option>
                          @endforeach

                        </select>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Trình độ chuyên môn</label>
                        <select name="level" class="form-control" id="exampleFormControlSelect1">
                          @foreach($level as $item)
                          <option  value="{{ $item->id }}" {{ $item->id == $getStaff->level ? 'selected' : '' }}>{{ $item->qualification_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Chuyên môn hóa</label>
                        <select name="specializes" class="form-control" id="exampleFormControlSelect1">
                          @foreach($specializes as $item)
                          <option  value="{{ $item->id }}" {{ $item->id == $getStaff->specializes ? 'selected' : '' }}>{{ $item->name_specializes }}</option>
                          @endforeach
                        </select>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Phòng</label>
                        <select name="rooms" class="form-control" id="exampleFormControlSelect1">
                          @foreach($rooms as $item)
                          <option value="{{ $item->id }}" {{ $item->id == $getStaff->rooms ? 'selected' : '' }}>{{ $item->room_name }}</option>
                          @endforeach

                        </select>
                      </div>   
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Chức vụ</label>
                        <select name="positions" class="form-control" id="exampleFormControlSelect1">
                          @foreach($positions as $item)
                          <option value="{{ $item->id }}" {{ $item->id == $getStaff->positions ? 'selected' : '' }}>{{ $item->name_position }}</option>
                          @endforeach

                        </select>
                      </div> 
                      <div class="col-12 p-0  text-center">
                        @if (\Session::has('msg'))
                        <span class="text-success mt-2">{!! \Session::get('msg') !!}</span>
                        @endif
                      </div>
                      <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                        <button class="btn bg text-white">Chỉnh sửa nhân viên</button>
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
<script src="{{ asset('index/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('index/js/validate/jquery.validate.min.js') }}" ></script>
<script src="{{ asset('index/js/validate/validate.js') }}"></script>
@endsection








