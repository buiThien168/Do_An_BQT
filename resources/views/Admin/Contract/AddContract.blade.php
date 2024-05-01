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
                   <h5 class="card-title mb-4 font-weight-bold ml-2 mt-2 tx">Thêm hợp đồng</h5>
                   <form id="form-add-steff" method="post" action="{{url('admin/contract-management/edit')."/".$id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-0">
                      <div class="col-12 px-2">
                        <p class="font-weight-bold">| Thông tin hợp đồng</p>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Tên hợp đồng</label>
                        <input type="text" name="name_contract" class="form-control mr-2"  autocomplete="off"
                        value="{{ $getContract != null ? $getContract->name_contract : ""}}"
                        >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Mã hợp đồng</label>
                        <input type="text" name="contract_number" class="form-control mr-2"  autocomplete="off"
                        value="{{ $getContract != null ? $getContract->contract_number : ""}}">
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Loại hợp đồng</label>
                        <select name="contract_type" class="form-control" id="exampleFormControlSelect1">
                          <option value="0"  {{$getContract != null && $getContract->contract_type == 0 ? 'selected' : '' }}>Dài hạn</option>
                          <option value="1" {{$getContract != null && $getContract->contract_type == 1 ? 'selected' : '' }}>Ngắn hạn</option> 
                        </select>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày kí hợp đồng</label>
                        <input type="date" name="signing_date" class="form-control mr-2" autocomplete="off" 
                        value="{{ $getContract != null ? \Carbon\Carbon::parse($getContract->signing_date)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d') : ""}}">

                      </div>    
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày bắt đầu</label>
                        <input type="date" name="start_date" class="form-control mr-2" autocomplete="off" 
                        value="{{$getContract != null ? \Carbon\Carbon::parse($getContract->start_date)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d') : ""}}">
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày kết thúc</label>
                        <input type="date" name="start_end" class="form-control mr-2" autocomplete="off" 
                        value="{{ $getContract != null ? \Carbon\Carbon::parse($getContract->start_end)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d') : ""}}">
                      </div>
                      <div class="col-12 px-2 mt-3">
                        <p class="font-weight-bold">| Thông tin đại diện bên A</p>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Họ tên</label>
                        <input type="text" value="{{ $getContract != null ? $getContract->name_A : $getUser->full_name}}" name="name_A" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày sinh</label>
                        <input type="date" name="birth_A" value="{{ $getContract != null ? \Carbon\Carbon::parse($getContract->birth_A)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d') : \Carbon\Carbon::parse($getUser->date_of_birth)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')}}" class="form-control mr-2" autocomplete="off" >
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Số điện thoại</label>
                        <input type="number" name="phone_number_A" class="form-control mr-2" autocomplete="off" value="{{ $getContract != null ? $getContract->phone_number_A : $getUser->user->phone}}">
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Email</label>
                        <input type="email" name="email_A" class="form-control mr-2" autocomplete="off" 
                        value="{{ $getContract != null ? $getContract->email_A : $getUser->email}}">
                      </div>
                      <div class="col-12 px-2 mt-3">
                        <p class="font-weight-bold">| Thông tin đại diện bên B</p>
                      </div>  
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Họ tên</label>
                        <input type="text" name="name_B" class="form-control mr-2" autocomplete="off" 
                        value="{{ $getContract != null ? $getContract->name_B : ""}}">
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Ngày sinh</label>
                        <input type="date" name="birth_B" class="form-control mr-2" autocomplete="off" 
                        value="{{ $getContract != null ? \Carbon\Carbon::parse($getContract->birth_B)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d') : ""}}">
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Số điện thoại</label>
                        <input type="number" name="phone_number_B" class="form-control mr-2" autocomplete="off" 
                        value="{{ $getContract != null ? $getContract->phone_number_B : ""}}">
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Email</label>
                        <input type="email" name="email_B" class="form-control mr-2" autocomplete="off" 
                        value="{{ $getContract != null ? $getContract->email_B : ""}}">
                      </div>
                      <div class="col-12 px-2 mt-3">
                        <p class="font-weight-bold">| Thông tin khác</p>
                      </div>  
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Bộ phận</label>
                        <select name="position" class="form-control" id="exampleFormControlSelect1">\
                          @if($getContract != null)
                            @foreach($positions as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $getContract->positions ? 'selected' : '' }}>{{ $item->name_position }}</option>
                            @endforeach
                          @else
                          @foreach($positions as $item)
                            <option value="{{ $item->id }}">{{ $item->name_position }}</option>
                            @endforeach
                          @endif
                        </select>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Mức lương cơ bản</label>
                        <input type="number" name="basic_salary" class="form-control mr-2" autocomplete="off" 
                        value="{{ $getContract != null ? $getContract->basic_salary : ""}}">
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Loại nhân viên</label>
                        <select name="employee_type" class="form-control" id="exampleFormControlSelect1">
                    @if($getContract != null)
                        @foreach($employee_type as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $getContract->employee_type ? 'selected' : '' }}>{{ $item->name }}
                        </option>
                        @endforeach
                        @else
                        @foreach($employee_type as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}
                        </option>
                        @endforeach
                        @endif
                          

                        </select>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Trình độ học vấn</label>
                        <select name="educationals" class="form-control" id="exampleFormControlSelect1">
                          @if($getContract != null)
                          @foreach($educational as $item)
                          <option value="{{ $item->id }}" {{ $item->id == $getContract->educationals ? 'selected' : '' }}>{{ $item->name_education }}</option>
                          @endforeach
                          @else
                          @foreach($educational as $item)
                          <option value="{{ $item->id }}">{{ $item->name_education }}</option>
                          @endforeach
                          @endif
                        </select>
                      </div>
                      <div class="col-12 col-sm-4 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Điều khoản</label>
                        <textarea name="note" class="form-control mr-2" placeholder="Điều khoản">{{$getContract != null ? $getContract->note : ""}}</textarea>
                      </div>
                      <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                        <button class="btn bg text-white">Cập nhật hợp đồng</button>
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
{{-- <script src="{{ asset('index/js/jquery-3.6.0.js') }}"></script> --}}
{{-- <script src="{{ asset('index/js/validate/jquery.validate.min.js') }}" ></script> --}}
{{-- <script src="{{ asset('index/js/validate/validate.js') }}"></script> --}}
@endsection








