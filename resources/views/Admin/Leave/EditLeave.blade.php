@extends("Admin.Layouts.Master")
@section('Title', 'Update Salary')
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
                   <h5 class="card-title mb-4 font-weight-bold ml-2 mt-2 tx">Cập nhật nghỉ phép</h5>
                   <form  method="post" action="{{url('admin/take-leave/edit')."/".$id}}">
                    @csrf
                    <div class="row m-0">
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Nội dung</label>
                        <input type="text" name="inputAttendes" class="form-control mr-2" value="{{ $EditLeave != null ? $EditLeave->title : ""}}" autocomplete="off" required>
                      </div>  
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label for="fz85 selectBreaks">Thời gian nghỉ:</label>
                        <select class="form-control" id="selectBreaks" name="selectBreaks">
                          <option value="1" @if($EditLeave->type == 1) selected @endif>Cả ngày</option>
                          <option value="2" @if($EditLeave->type == 2) selected @endif>Nửa buổi</option>
                        </select>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label for="fz85 check_event">Check:</label>
                        <select class="form-control" id="check_event" name="check_event">
                            <option value="1" @if($EditLeave->check_event == 1) selected @endif>Đã duyệt</option>
                          <option value="0" @if($EditLeave->check_event == 0) selected @endif>Chưa duyệt</option>
                        </select>
                      </div>   
                     
                      <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                        <button class="btn bg text-white">Cập nhật</button>
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








