@extends("Admin.Layouts.Master")
@section('Title', 'Contract List')
@section('Content')
<style type="text/css">
  @media only screen and (max-width: 900px) {
    td{
      white-space: nowrap;
    }
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
            <div class="row">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0 p-0">
                <div>
                  <div>
                   <div class="bg-white">
                    <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body px-0">
                         <h5 class="card-title float-left mb-2 tx">Hợp đồng</h5>
                         <div class="float-right"> 
                          <form method="get">    
                            <div class="form-group mb-3" style="display: flex">               
                              <input type="text" class="form-control"  placeholder="Name" name="keyword">
                              <button type="submit" class="btn bg text-white ml-2" style="width: 120px;">Tìm kiếm</button>
                            </div>
                          </form> 
                        </div>
                        <div style="clear: both;"></div>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <thead>
                              <th width="3%">#</th>
                              <th width="10%">Mã NV</th>
                              <th width="20%">Họ tên</th>
                              <th width="20%">SĐT</th>
                              <th width="20%">Gmail</th>
                              <th width="30%">Hoạt động</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($GetUsers as $item)
                             <tr>
                              <td>{{$idup++}}</td>
                              <td>L{{$item->id}}</td>
                              <td>
                                {{$item->full_name}}
                              </td>
                              <td>{{$item->phone}}</td>
                              <td>{{$item->email}}</td>
                              
                             <td>
                             @if($item->contracts == 0)
                              <a href="{{url('admin/contract-management/edit')."/".$item->id}}">
                                <button class="btn btn-success mr-2 text-white">Cập nhật</button>
                              </a>
                              @else
                              <a href="{{url('admin/contract-management/edit')."/".$item->id}}">
                                <button class="btn btn-danger mr-2">Sửa</button>
                              </a>    
                              @endif 
                              @if($item->contracts == 0)
                              <a href="#">
                                <button class="btn btn-secondary mr-2 text-white">Chưa cập nhật</button>
                              </a>
                              @elseif($item->contracts == 2)
                              <a href="#">
                                <?php
                                  $start_date = $item->start_date;
                                  $end_date = $item->start_end;
                                  $current_time = time();
                                  $time_left = $end_date - $current_time;
                                  $days_left = 0;
                                  if ($time_left > 0) {
                                  $days_left = floor($time_left / (60 * 60 * 24));
                                  }
                                  ?>
                                <?php if ($days_left > 0): ?>
                                <button class="btn btn-warning mr-2 text-white">
                                  Còn lại <?php echo $days_left; ?> ngày
                                </button>
                                <?php endif; ?>
                              </a>
                             @else
                             <a href="#">
                              <button class="btn btn-success mr-2">Còn hạn</button>
                            </a> 
                            <a href="{{url('admin/contract-management/export')."/".$item->id}}">
                              <button class="btn bg mr-2 text-white">Xuất word</button>
                            </a>
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











