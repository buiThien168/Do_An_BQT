@extends("Admin.Layouts.Master")
@section('Title', 'Payroll')
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
                         <h5 class="card-title float-left mb-2 tx">Lương bổng</h5>
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
                              <th width="4%">Mã số</th>
                              <th width="15%">Tên</th>
                               <th width="15%">Chức vụ</th>
                              <th width="15%">Tiền công</th>
                              <th width="15%">Lương tạm thời</th>
                              <th width="20%">Hoạt động</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($getStaff as $item)
                             <tr>
                              <td>{{$idup++}}</td>
                              <td>L{{$item->id}}</td>
                              <td>
                                {{$item->full_name}}
                              </td>
                              <td>
                                {{$item->name_position}}
                             </td>
                              <td>
                               {{number_format($item->hourly_salary)}}$
                             </td>

                              <td>
                               @foreach($checktime as $item2)
                              @if($item->id == $item2['id'])
                              {{number_format($item2['salary'])}}$
                              @endif
                              @endforeach
                              </td>
                            
                             <td>
                              <a href="{{url('/admin/salary-management/payroll/detail')."/".$item->id}}">
                                <button class="btn bg mr-2 text-white">Xem chi tiết</button>
                              </a>                         
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
             {{ $getStaff->links('pagination::bootstrap-4') }}
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











