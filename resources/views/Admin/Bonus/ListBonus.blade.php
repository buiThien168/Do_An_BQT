@extends("Admin.Layouts.Master")
@section('Title', 'List of Rewards')
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
                         <h5 class="card-title float-left mb-2 tx">Danh sách khen thưởng</h5>
                         <div class="float-right"> 
                          <form method="get">    
                            <div class="form-group mb-3" style="display: flex"> 
                              <a href="{{url('admin/bonus/add')}}">
                                <div class="btn btn-success mr-2" style="width: 140px;">Tạo khen thưởng</div>      
                              </a> 
                              <input type="text" class="form-control"  placeholder="ID/Name" name="keyword">
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
                              <th width="15%">Nội dung</th>
                              <th width="15%">Giá trị</th>
                              <th width="15%">Ngày tạo</th>
                              <th width="20%">Hoạt động</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($GetBonus as $item)
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
                                {{$item->note}}
                              </td>
                              <td>
                                {{number_format($item->value)}}đ 
                              </td>
                              <td>
                               {{\Carbon\Carbon::parse($item->created)->format('d/m/Y')}}
                             </td>
                             <td>
                              <a href="{{url('admin/bonus/edit')."/".$item->id}}">
                                <button class="btn btn-success mr-2 text-white">Sửa</button>
                              </a>                       
                              <button class="btn btn-danger"  data-toggle="modal" data-target="#exampleModalUnLock{{$item->id}}">Xóa</button>              
                            </td>
                          </tr>

                           <div class="modal fade mt-5" id="exampleModalUnLock{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Xóa khen thưởng</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                 <p>Bạn có đồng ý Xóa khen thưởng <span class="text-danger">{{$item->nick_name}}</span> ?</p>
                               </div>
                               <div class="p-2">
                                 <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Hủy bỏ</button>
                                 <a  href="{{url('admin/bonus/delete')."/".$item->id}}">
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
             {{ $GetBonus->links('pagination::bootstrap-4') }}
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











