@extends("Admin.Layouts.Master")
@section('Title', 'Job')
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
                   <h5 class="card-title mb-4 font-weight-bold ml-2 mt-2 tx">Công việc</h5>

                   <form id="form-add-department" method="post" action="{{url('admin/workflow-management/add')}}">
                    @csrf
                    <div class="row m-0">
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Chọn người dùng</label>
                        <select name="user_id" class="form-control" id="exampleFormControlSelect1">
                          @foreach($getUsers as $item)
                          <option value="{{$item->user_id}}">{{$item->full_name}}</option>
                          @endforeach

                        </select>
                      </div>  
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Tên công việc</label>
                        <input type="text" name="work_name" class="form-control mr-2" autocomplete="off" required>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Chi tiết</label>
                        <input type="text" name="note" class="form-control mr-2" autocomplete="off" required>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Từ</label>
                        <input type="date" name="from" class="form-control mr-2" autocomplete="off" required>
                      </div> 
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                        <label class="fz85">Đến</label>
                        <input type="date" name="to" class="form-control mr-2" autocomplete="off" required>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2 pt-4">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="email_notification">
                            Gửi thông báo tới email
                          </label>
                        </div>
                      </div> 
                      <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                        <button class="btn bg text-white">Tạo công việc</button>
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








