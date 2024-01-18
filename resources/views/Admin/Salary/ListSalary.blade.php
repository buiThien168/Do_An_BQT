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
    <div class="side-bar-box" style="width: 250px;">
      <x-admin.layouts.side-bar/>
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
                         <h5 class="card-title float-left mb-2 tx">Danh sách lương</h5>
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
                              <th width="15%">Trình độ chuyên môn</th>
                              <th width="15%">Tiền công</th>
                              <th width="15%">Ngày tạo</th>
                              <th width="20%">Hoạt động</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($GetSalarys as $item)
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
                                
                                {{$item->qualification_name}}

                              </td>
                              <td>
                                @if($item->hourly_salary == null)
                                Not update
                                @else
                                {{number_format($item->hourly_salary)}}$ / hour
                                @endif
                              </td>
                              <td>
                               {{\Carbon\Carbon::parse($item->created)->format('d/m/Y')}}
                             </td>

                             <td>
                              <a href="{{url('/admin/user-management/detail')."/".$item->id}}">
                                <button class="btn bg mr-2 text-white">Xem chi tiết</button>
                              </a>
                               @if($item->hourly_salary == null)
                              <a href="{{url('admin/salary-management/edit')."/".$item->id}}">
                                <button class="btn btn-success mr-2 text-white">Cập nhật</button>
                              </a>
                              @else
                              <a href="{{url('admin/salary-management/edit')."/".$item->id}}">
                                <button class="btn btn-danger mr-2">Sửa</button>
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
           {{ $GetSalarys->links('pagination::bootstrap-4') }}
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











