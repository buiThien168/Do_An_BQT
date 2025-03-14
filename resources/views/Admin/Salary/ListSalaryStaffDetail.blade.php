@extends("Admin.Layouts.Master")
@section('Title', 'Salary List')
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
                         <h5 class="card-title float-left mb-2 tx">Danh sách chi tiết chấm công</h5>
                         <div class="float-right"> 
                          <div class="d-flex">
                            <p>Lương cơ bản: {{number_format($GetSalary)}}đ |</p>
                            <p>| Tổng số công tháng {{$month}} : {{$totalWorkHours}}</p>
                            <div class="ml-3">
                            <form method="get">    
                              <div class="form-group mb-3" style="display: flex">               
                                <input type="month" class="form-control"  placeholder="Name" name="keyword">
                                <button type="submit" class="btn bg text-white ml-2" style="width: 120px;">Tìm kiếm</button>
                              </div>
                            </form> 
                          </div>
                          </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <thead>
                              <th width="3%">#</th>
                              <th width="20%">Ngày</th>
                              <th width="20%">giờ vào</th>
                              <th width="20%">giờ ra</th>
                              <th width="20%">Thời gian ghi</th>
                              <th width="27%">Điểm danh</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($checktime as $item)
                             <tr>
                              <td>{{$idup++}}</td>
                              <td>
                                {{\Carbon\Carbon::parse($item['checkin'])->setTimezone('Asia/Ho_Chi_Minh')->format('Y/m/d')}}
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
                            {{-- {{number_format($item['salary'])}}$ --}}
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











