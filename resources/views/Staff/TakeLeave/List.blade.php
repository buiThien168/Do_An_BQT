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
  <x-staff.layouts.header-dashboard />
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
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
                         <h5 class="card-title float-left mb-2 tx">Danh sách xin nghỉ</h5>
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
                              <th width="20%">Tên</th>
                              <th width="20%">Nội dung</th>
                              <th width="18%">Ngày tạo</th>
                              <th width="10%">Thời gian</th>
                              <th width="10%">Trạng thái</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($GetListLeave as $item)
                             <tr>
                              <td>{{$idup++}}</td>
                              <td>
                                {{$item->full_name}}
                              </td>
                              <td>
                                {{$item->title}}
                              </td>
                              <td>
                               From {{\Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y')}}
                              </td>
                              <td>
                                @if($item->type == 2)
                                <span class="text-warning">Nửa buổi</span>
                                @else
                                 <span class="text-success">Cả ngày</span>
                                @endif
                               </td>
                              <td>
                               @if($item->check_event == 1)
                               <span class="text-success">Đã duyệt</span>
                               @else
                                <span class="text-warning">Chưa duyệt</span>
                               @endif
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
                                 <p>Bạn đồng ý xóa đơn nghỉ?</p>
                               </div>
                               <div class="p-2">
                                 <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Hủy bỏ</button>
                                 <a  href="{{url('admin/take-leave/delete')."/".$item->id}}">
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
             {{ $GetListLeave->links('pagination::bootstrap-4') }}
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
