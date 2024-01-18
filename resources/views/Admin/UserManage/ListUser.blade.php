@extends("Admin.Layouts.Master")
@section('Title', 'Account management')
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
    <div class="side-bar-box" style="width: 250px;">
      <x-admin.layouts.side-bar />
    </div>
    <div class="main-panel">
      <div class="content-wrapper p-3">
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
                            <h5 class="card-title float-left mb-2 tx">Quản lý tài khoản</h5>
                            <div class="float-right">
                              <form method="get">
                                <div class="form-group mb-3" style="display: flex">
                                  <input type="text" class="form-control" placeholder="Enter ID / Code / Name" name="keyword">
                                  <button type="submit" class="btn bg text-white ml-2" style="width: 100px;">Tìm kiếm</button>
                                </div>
                              </form>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="table-responsive">
                              <table class="table table-hover table-striped">
                                <thead>
                                  <th width="3%">#</th>
                                  <th width="4%">Mã số</th>

                                  <th width="12%">Tên</th>
                                  <th width="8%">Điện thoại</th>
                                  <th width="10%">Email</th>
                                  <th width="10%">Kiểu tài khoản</th>
                                  <th width="10%">Trạng thái</th>
                                  <th width="17%">Hoạt động</th>
                                </thead>
                                <tbody>
                                  <p style="display: none">{{$idup = 1}}</p>
                                  @foreach($GetUsers as $item)
                                  <tr>
                                    <td>{{$idup++}}</td>

                                    <td>{{$item->id}}</td>

                                    <td>
                                      {{$item->full_name}}
                                    </td>

                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                      @if($item->role ==2) Regular account @elseif($item->role ==1) Admin @endif
                                    </td>
                                    <td>@if($item->active ==1)Active @else Temporarily locked @endif</td>

                                    <td>
                                      <a href="{{url('admin/user-management/detail')."/".$item->id}}">
                                        <button class="btn bg mr-2 text-white">Xem chi tiết</button>
                                      </a>
                                      @if($item->active == 1)
                                      <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalBlock{{$item->id}}">Bị khóa tạm thời</button>
                                      @elseif($item->active == 0)
                                      <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalUnLock{{$item->id}}">Mở khóa</button>
                                      @endif
                                    </td>
                                  </tr>
                                  <div class="modal fade mt-5" id="exampleModalBlock{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Khóa tài khoản</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Khi bạn khóa tài khoản {{$item->full_name}}, {{$item->full_name}} sẽ không thể đăng nhập vào hệ thống.</p>
                                        </div>
                                        <div class="p-2">
                                          <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Hủy bỏ</button>
                                          <a href="{{url('admin/user-management/lock-mine-employee')."/".$item->id}}">
                                            <button type="button" class="btn btn-danger float-right mr-2">
                                              Nhìn
                                            </button>
                                          </a>


                                          <div style="clear: both"></div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="modal fade mt-5" id="exampleModalUnLock{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Mở khóa người dùng</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Khi bạn mở khóa tài khoản của mình {{$item->full_name}}, {{$item->full_name}} sẽ có thể đăng nhập vào hệ thống.</p>
                                        </div>
                                        <div class="p-2">
                                          <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Hủy bỏ</button>
                                          <a href="{{url('admin/user-management/lock-mine-employee')."/".$item->id}}">
                                            <button type="button" class="btn btn-success float-right mr-2">
                                              Mở khóa
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

                    <div class="float-right pr-3">
                      {{ $GetUsers->links('pagination::bootstrap-4') }}
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
  </div>

  @endsection