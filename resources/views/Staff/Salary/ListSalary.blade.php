@extends("Staff.Layouts.Master")
@section('Title', 'Salary List')
@section('Content')
<style type="text/css">
  @media only screen and (max-width: 900px) {
    td {
      white-space: nowrap;
    }
  }
</style>
<div class="container-scroller">
  <x-staff.layouts.header-dashboard />
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
      <div id="settings-trigger"><i class="ti-settings"></i></div>
      <div id="theme-settings" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
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
     
    </div>
    <div class="sidebar sidebar-offcanvas">
      <x-staff.layouts.side-bar />
    </div>
    <div class="main-panel">
      <div class="content-wrapper">
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
                            <h5 class="card-title float-left mb-2 tx">Danh sách lương</h5>
                            <div class="float-right">
                              <div class="d-flex">
                                <p>Lương cơ bản: {{number_format($GetSalary)}}$ |</p>
                                <p>| Tổng số công tháng {{$month}} : {{$totalWorkHours}}</p>
                              </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="table-responsive">
                              <table class="table table-hover table-striped">
                                <thead>
                                  <th width="3%">#</th>
                                  <th width="20%">Ngày</th>
                                  <th width="20%">Giờ vào</th>
                                  <th width="20%">Giờ ra</th>
                                  <th width="20%">Thời gian</th>
                                  <th width="27%">Điểm danh</th>
                                </thead>
                                <tbody>
                                  <p style="display: none">{{$idup = 1}}</p>
                                  @foreach($checktime as $item)
                                  <tr>
                                    <td>{{$idup++}}</td>
                                    <td>
                                      {{\Carbon\Carbon::parse($item['checkin'])->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y')}}
                                    </td>
                                    <td>
                                      {{\Carbon\Carbon::parse($item['checkin'])->setTimezone('Asia/Ho_Chi_Minh')->format('H:i')}}
                                    </td>
                                    <td>
                                      {{\Carbon\Carbon::parse($item['checkout'])->setTimezone('Asia/Ho_Chi_Minh')->format('H:i')}}
                                    </td>
                                    <td>
                                      {{$item['time']}}
                                    </td>
                                    <td>
                                      @if($item['work_month']==0.5)
                                      Nửa buổi
                                    @else
                                      Cả ngày
                                    @endif
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="float-right pr-3">

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