@extends("Admin.Layouts.Master")
@section('Title', 'List of users')
@section('Content')
<style type="text/css">
  @media only screen and (max-width: 900px) {
    td {
      white-space: nowrap;
    }
  }
</style>
<div class="container-scroller">
  <x-admin.layouts.header-dashboard />
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
    </div>
    <div class="sidebar sidebar-offcanvas">
      <x-admin.layouts.side-bar />
    </div>
    <div class="main-panel relative">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
              <div class="card-people mt-auto">
                <img src="{{asset('images/avatars/people.svg')}}" alt="people">
                <div class="weather-info">
                  <div class="d-flex">
                    <div>
                      <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>28<sup>C</sup></h2>
                    </div>
                    <div class="ml-2">
                      <h4 class="location font-weight-normal">Thai Nguyen</h4>
                      <h6 class="font-weight-normal">Viet Nam</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 grid-margin transparent">
            <div class="row">
              <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-tale" data-toggle="modal" data-target="#ModalOnline">
                  <div class="card-body">
                    <p class="mb-4">Nhân viên đi làm trong ngày</p>
                    <p class="fs-30 mb-2">{{ $checkOnlineStaff->count() }}</p>
                    <p>{{now()}}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue" data-toggle="modal" data-target="#ModalOFF">
                  <div class="card-body">
                    <p class="mb-4">Nhân viên chưa điểm danh</p>
                    <p class="fs-30 mb-2">{{$checkOffStaff->count()}}</p>
                    <p>{{now()}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <p class="mb-4">Nhân Viên</p>
                    <p class="fs-30 mb-2">{{$GetListStaffs->count()}} User</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 stretch-card transparent">
                <div class="card card-light-danger">
                  <div class="card-body">
                    <p class="mb-4">Công việc hoàn thành</p>
                    <p class="fs-30 mb-2">{{$checkWorkSuccessService->count()}}</p>
                    <p>{{$checkWork->count()}} work</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0 p-0">
                <div>
                  <div>
                    <div class="bg-white">
                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body px-0">
                            <h5 class="card-title float-left mb-2 tx">Danh sách người dùng</h5>
                            <div class="float-right">
                              <form method="get">
                                <div class="form-group mb-3" style="display: flex">
                                  <a href="{{url('admin/user-management/add-employees')}}">
                                    <div class="btn btn-success mr-2" style="width: 120px;">Thêm người dùng</div>
                                  </a>
                                  <input type="text" class="form-control" placeholder="Enter ID / Code / Name"
                                    name="keyword">
                                  <button type="submit" class="btn bg text-white ml-2" style="width: 120px;">Tìm
                                    kiếm</button>
                                </div>
                              </form>
                            </div>
                          </div>
                          <div style="clear: both;"></div>
                          <div class="table-responsive">
                            <table class="table table-hover table-striped">
                              <thead>
                                <th width="3%">#</th>
                                <th width="5%">Mã số</th>
                                <th width="5%">Avatar</th>
                                <th width="15%">Họ tên</th>
                                <th width="6%">Giới tính</th>
                                <th width="10%">Ngày sinh</th>
                                <th width="10%">Nơi sinh</th>
                                <th width="10%">Chức vụ</th>
                                <th width="18%">Hoạt động</th>
                              </thead>
                              <tbody>
                                <p style="display: none">{{$idup = 1}}</p>
                                @foreach($GetListStaffs as $item)
                                <tr>
                                  <td>{{$idup++}}</td>
                                  <td>NV{{$item->user_id}}</td>
                                  <td>
                                    @if(isset($item->image))
                                    <img src="{{ asset('images/staff')."/".$item->image}}">
                                    @else
                                    <img src="{{ asset('images/staff/default.png')}}">
                                    @endif
                                  </td>
                                  <td>{{$item->full_name}}</td>
                                  <td>
                                    @if($item->sex == 0)
                                    Nam
                                    @else
                                    Nữ
                                    @endif
                                  </td>
                                  <td>
                                    {{\Carbon\Carbon::parse($item->date_of_birth)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')}}
                                  </td>
                                  <td>{{$item->place_of_birth}}</td>
                                  <td>{{$item->position}}</td>
                                  <td>
                                    <a href="{{url('admin/user-management/detail')."/".$item->user_id}}">
                                      <button class="btn bg mr-2 text-white">Xem chi tiết</button>
                                    </a>
                                    <a href="{{url('admin/user-management/edit')."/".$item->user_id}}">
                                      <button class="btn btn-danger mr-2">Sửa</button>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal"
                                      data-target="#exampleModalBlock{{$item->user_id}}">Xóa
                                    </button>
                                  </td>
                                </tr>

                                <div class="modal fade mt-5" id="exampleModalBlock{{$item->user_id}}" tabindex="-1"
                                  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa người dùng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <p>Khi bạn xóa một nhân viên {{$item->nick_name}}, {{$item->nick_name}} sẽ không
                                          thể đăng nhập vào hệ thống.</p>
                                      </div>
                                      <div class="p-2">

                                        <a href="{{url('admin/user-management/delete')."/".$item->user_id}}">
                                          <button type="button" class="btn btn-secondary float-right"
                                            data-dismiss="modal">Hủy bỏ</button>
                                        </a>
                                        <a href="{{url('admin/user-management/delete')."/".$item->user_id}}">
                                          <button type="button" class="btn btn-danger float-right mr-2">
                                            Đồng ý
                                          </button>
                                        </a>
                                        <div style="clear: both"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="float-right pr-3">
                  {{ $GetListStaffs->links('pagination::bootstrap-4') }}
                </div>
                <div style="clear: both"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- ModalOnline --}}
<div class="modal fade" id="ModalOnline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <p class="ml-2 mt-3">Nhân viên đã điểm danh {{now()}}</p>
      <table class="table">
        <thead>
          <tr>
            <th scope="5%">#</th>
            <th width="45%">Họ tên</th>
            <th width="25%">Avatar</th>
            <th width="25%">Email</th>
          </tr>
        </thead>
        <tbody>
          <p style="display: none">{{$idupOn = 1}}</p>
          @foreach($checkOnlineStaff as $item)
            <tr>
              <td>{{$idupOn++}}</td>
              <td>{{$item->full_name}}</td>
              <td>@if(isset($item->image))
                <img src="{{ asset('images/staff')."/".$item->image}}">
                @else
                <img src="{{ asset('images/staff/default.png')}}">
                @endif</td>
              <td>{{$item->email}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
{{-- End ModalOnline --}}
{{-- ModalOff --}}
<div class="modal fade" id="ModalOFF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <p class="ml-2 mt-3">Nhân viên không đi làm {{now()}}</p>
      <table class="table">
        <thead>
          <tr>
            <th scope="5%">#</th>
            <th width="45%">Họ tên</th>
            <th width="25%">Avatar</th>
            <th width="25%">Email</th>
          </tr>
        </thead>
        <tbody>
          <p style="display: none">{{$idupOn = 1}}</p>
          @foreach($checkOffStaff as $item)
            <tr>
              <td>{{$idupOn++}}</td>
              <td>{{$item->full_name}}</td>
              <td>@if(isset($item->image))
                <img src="{{ asset('images/staff')."/".$item->image}}">
                @else
                <img src="{{ asset('images/staff/default.png')}}">
                @endif</td>
              <td>{{$item->email}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
{{-- End ModalOff --}}
@endsection