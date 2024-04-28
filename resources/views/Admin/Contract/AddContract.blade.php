@extends("Admin.Layouts.Master")
@section('Title', 'Add contract')
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
                   <h5 class="card-title mb-4 font-weight-bold ml-2 mt-2 tx">Thêm họp đồng</h5>
                   <form id="form-add-steff" method="post" action="{{url('admin/user-management/add-employees')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-0">
                      <div class="col-12 px-2">
                        <p class="font-weight-bold">| Thông tin hợp đồng</p>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Mã hợp đồng</label>
                        <input type="text" name="nick_name" class="form-control mr-2"  autocomplete="off">
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Loại hợp đồng</label>
                        <select name="sex" class="form-control" id="exampleFormControlSelect1">
                          <option value="0">Dài hạn</option>
                          <option value="1">Ngắn hạn</option> 
                        </select>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Image</label>
                        <input type="file" name="image" class="form-control mr-2" accept="image/png, image/gif, image/jpeg">
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày kí hợp đồng</label>
                        <input type="date" name="date_range" class="form-control mr-2" autocomplete="off" >
                      </div>    
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày bắt đầu</label>
                        <input type="date" name="date_range" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày kết thúc</label>
                        <input type="date" name="date_range" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 px-2 mt-3">
                        <p class="font-weight-bold">| Thông tin đại diện bên A</p>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Họ tên</label>
                        <input type="text" name="date_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày sinh</label>
                        <input type="date" name="date_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Số điện thoại</label>
                        <input type="number" name="place_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Email</label>
                        <input type="email" name="place_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 px-2 mt-3">
                        <p class="font-weight-bold">| Thông tin đại diện bên B</p>
                      </div>  
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Họ tên</label>
                        <input type="text" name="date_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày sinh</label>
                        <input type="date" name="date_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Số điện thoại</label>
                        <input type="number" name="place_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Email</label>
                        <input type="email" name="place_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 px-2 mt-3">
                        <p class="font-weight-bold">| Thông tin khác</p>
                      </div>  
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Bộ phận</label>
                        <select name="employee_type" class="form-control" id="exampleFormControlSelect1">
                          {{-- @foreach($employee_type as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                          @endforeach --}}
                        </select>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Mức lương cơ bản</label>
                        <input type="number" name="place_of_birth" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Chức vụ</label>
                        <select name="positions" class="form-control" id="exampleFormControlSelect1">
                          {{-- @foreach($positions as $item)
                          <option value="{{$item->id}}">{{$item->name_position}}</option>
                          @endforeach --}}

                        </select>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Trình độ học vấn</label>
                        <select name="educational" class="form-control" id="exampleFormControlSelect1">
                          {{-- @foreach($educational as $item)
                          <option value="{{$item->id}}">{{$item->name_education}}</option>
                          @endforeach --}}

                        </select>
                      </div>
                      <div class="col-12 col-sm-4 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Điều khoản</label>
                        <textarea class="form-control mr-2" placeholder="Điều khoản"></textarea>
                      </div>
                      <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                        <button class="btn bg text-white">Thêm người dùng</button>
                      </div>
                    </div>
                    @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif
                    @if (\Session::has('msg'))
                    <p class="text-danger mt-2 text-center mb-0 fz-95">{!! \Session::get('msg') !!}</p>
                    @endif
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








