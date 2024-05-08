@extends("Staff.Layouts.Master")
@section('Title', 'Work list')
@section('Content')
<style type="text/css">
  @media only screen and (max-width: 900px) {
    td{
      white-space: nowrap;
    }
  }
</style>
<div class="container-scroller">
  <x-staff.layouts.header-dashboard/>
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
    </div>
    <div class="sidebar sidebar-offcanvas">
      <x-staff.layouts.side-bar/>
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
                            <h5 class="card-title float-left mb-2 tx">Thông tin hợp đồng</h5>
                            <div class="table-responsive">
                             @if($contract != null)
                              <div style="border-bottom: 1px solid #ae9ea3;margin:12px 0 12px 0;"></div>
                              <div>
                                <span><b>Tên hợp đồng</b> : <span>{{$contract->name_contract}}</span></span></br>
                              </div>
                              <div style="border-bottom: 1px solid #ae9ea3;margin:12px 0 12px 0;"></div>
                              <div style="width: 80%;">
                                <div style="width: 300px;float: left;">
                                  <span><b>Số hợp đồng</b> : <span>{{$contract->contract_number}}</span></span>
                                </div>
                                <div>
                                  <span><b>Loại hợp đồng</b> : <span>@if($contract->contract_type==0)
                                    Dài hạn
                                  @else
                                    Ngắn hạn
                                  @endif</span></span></br>
                                </div>
                              </div>
                              <div style="border-bottom: 1px solid #ae9ea3;margin:12px 0 12px 0;"></div>
                              <div style="width: 80%;">
                                <div style="width: 300px;float: left;">
                                  <span><b>Ngày bắt đầu</b> : <span>{{\Carbon\Carbon::parse($contract->start_date)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')}}</span></span>
                                </div>
                                <div>
                                  <span><b>Ngày kết thúc</b> : <span>{{\Carbon\Carbon::parse($contract->start_end)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')}}</span></span></br>
                                </div>
                              </div>
                              <div style="border-bottom: 1px solid #ae9ea3;margin:12px 0 40px 0;"></div>
                              <div>
                                <span><b>Đại diện bên A</b> : <span>{{$contract->name_A}}</span></span></br>
                              </div>
                              <div style="border-bottom: 1px solid #ae9ea3;margin:12px 0 12px 0;"></div>
                              <div style="width: 80%;">
                                <div style="width: 300px;float: left;">
                                  <span><b>Số điện thoại</b> : <span>{{$contract->phone_number_A}}</span></span>
                                </div>
                                <div>
                                  <span><b>Địa chỉ</b> : <span>{{$contract->address_A}}</span></span></br>
                                </div>
                              </div>
                              <div style="border-bottom: 1px solid #ae9ea3;margin:12px 0 40px 0;"></div>
                              <div>
                                <span><b>Đại diện bên B</b> : <span>{{$contract->name_B}}</span></span></br>
                              </div>
                              <div style="border-bottom: 1px solid #ae9ea3;margin:12px 0 12px 0;"></div>
                              <div style="width: 80%;">
                                <div style="width: 300px;float: left;">
                                  <span><b>CCCD</b> : <span>{{$contract->CCCD_B}}</span></span>
                                </div>
                                <div>
                                  <span><b>Ngày sinh</b> : <span>{{\Carbon\Carbon::parse($contract->birth_B)->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')}}</span></span></br>
                                </div>
                              </div>
                              <div style="border-bottom: 1px solid #ae9ea3;margin:12px 0 12px 0;"></div>
                              <div style="width: 80%;">
                                <div style="width: 300px;float: left;">
                                  <span><b>Số điện thoại</b> : <span>{{$contract->phone_number_B}}</span></span>
                                </div>
                                <div>
                                  <span><b>Địa chỉ</b> : <span>{{$contract->address_B}}</span></span></br>
                                </div>
                              </div>
                              <div style="border-bottom: 1px solid #ae9ea3;margin:12px 0 12px 0;"></div>
                              <div style="width: 80%;">
                                <div style="width: 300px;float: left;">
                                  <span><b>Tình trạng</b> : <span>
                                    <?php
                                  $start_date = $contract->start_date;
                                  $end_date = $contract->start_end;
                                  $current_time = time();
                                  $time_left = $end_date - $current_time;
                                  $days_left = 0;
                                  if ($time_left > 0) {
                                  $days_left = floor($time_left / (60 * 60 * 24));
                                  }
                                  ?>
                                <?php if ($days_left > 0): ?>
                                  Còn lại <?php echo $days_left; ?> ngày
                                <?php endif; ?>
                                  </span></span>
                                </div>
                                <div>
                                  <span><b>Ngày tái ký</b> : <span>
                                    <?php
                                      $birthDate = \Carbon\Carbon::parse($contract->start_end)->setTimezone('Asia/Ho_Chi_Minh');
                                      $renewalDate = $birthDate->copy()->addDay();
                                      $formattedRenewalDate = $renewalDate->format('Y-m-d');
                                      echo $formattedRenewalDate;
                                    ?>
                                  </span></span></br>
                                </div>
                              </div>
                              @else
                                <span>null</span>
                              @endif
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>

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











