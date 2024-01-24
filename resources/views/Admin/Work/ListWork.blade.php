@extends("Admin.Layouts.Master")
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
                         <h5 class="card-title float-left mb-2 tx">Danh sách công việc</h5>
                         <div class="float-right"> 
                          <form method="get">    
                            <div class="form-group mb-3" style="display: flex"> 
                              <a href="{{url('admin/workflow-management/add')}}">
                                <div class="btn btn-success mr-2" style="width: 140px;">Tạo công việc</div>      
                              </a> 
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
                              <th width="12%">Tên</th>
                              <th width="9%">Chức vụ</th>
                              <th width="18%">Công việc</th>
                              <th width="18%">Ngày</th>
                              <th width="10%">Trạng thái</th>
                              <th width="10%">Ngày tạo</th>
                              <th width="24%">Hoạt động</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($GetWork as $item)
                             <tr>
                              <td>{{$idup++}}</td>
                              <td>KT{{$item->id}}</td>
                              <td>
                                {{$item->full_name}}
                              </td>
                              <td>
                                {{$item->name_position}}
                              </td>
                              <td>
                                {{$item->work_name}}
                              </td>
                              <td>
                               From {{\Carbon\Carbon::parse($item->from)->format('d/m/Y')}} To {{\Carbon\Carbon::parse($item->to)->format('d/m/Y')}}
                              </td>
                              <td>
                               @if($item->status == 0)
                               <span class="text-warning">Xử lý</span>
                               @else
                                <span class="text-success">Hoàn thành</span>
                               @endif
                              </td>
                              <td>
                               {{\Carbon\Carbon::parse($item->created)->format('d/m/Y')}}
                             </td>
                             <td>
                              <a href="{{url('admin/workflow-management/job-details')."/".$item->id}}">
                                <button class="btn btn-success mr-2 text-white">Xem</button>
                              </a>
                              <a href="{{url('admin/workflow-management/edit')."/".$item->id}}">
                                <button class="btn btn-success mr-2 text-white">Sửa</button>
                              </a>                       
                              <button class="btn btn-danger"  data-toggle="modal" data-target="#exampleModalUnLock{{$item->id}}">Xóa</button>              
                            </td>
                          </tr>

                           <div class="modal fade mt-5" id="exampleModalUnLock{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Xóa công việc</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                 <p>Bạn đồng ý Xóa công việc?</p>
                               </div>
                               <div class="p-2">
                                 <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Hủy bỏ</button>
                                 <a  href="{{url('admin/workflow-management/delete')."/".$item->id}}">
                                  <button type="button" class="btn btn-danger float-right mr-2">
                                    Xóa                
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
             {{ $GetWork->links('pagination::bootstrap-4') }}
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











