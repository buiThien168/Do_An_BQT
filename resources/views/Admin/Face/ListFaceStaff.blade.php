@extends("Admin.Layouts.Master")
@section('Title', 'Identity management')
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
                         <h5 class="card-title float-left mb-2 tx">Quản lý danh tính</h5>
                         <div class="float-right"> 
                          <form method="get">    
                            <div class="form-group mb-3" style="display: flex">
                              <input type="text" class="form-control"  placeholder="Enter ID / Code / Name" name="keyword">
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
                              <th width="5%">Hình</th>
                              <th width="15%">Tên</th>
                              <th width="10%">Trạng thái</th>
                              <th width="15%">Hoạt động</th>
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
                              <td>
                                {{$item->full_name}}
                              </td>
                              
                              
                              <td>
                                @if($item->status == 0)
                                Đang làm việc
                                @elseif($item->status == 1)
                                Bỏ việc
                                @elseif($item->status == 2)
                                Nghỉ phép
                                @endif
                              </td>
                              <td>
                                <a href="{{url('admin/identity-management/view-data')."/".$item->user_id}}">
                                  <button class="btn bg mr-2 text-white">Xem dữ liệu</button>
                                </a>
                                <a href="{{url('admin/identity-management/register-again')."/".$item->user_id}}">
                                  <button class="btn btn-danger mr-2">Đăng ký lại</button>
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
</div>

@endsection











