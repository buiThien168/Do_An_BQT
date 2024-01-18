@extends("Admin.Layouts.Master")
@section('Title', 'List of Qualifications')
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
                         <h5 class="card-title float-left mb-2 tx">Danh sách trình độ chuyên môn</h5>
                         <div class="float-right"> 
                          <form method="get">    
                            <div class="form-group mb-3" style="display: flex"> 
                              <a href="{{url('admin/level-management/add')}}">
                                <div class="btn btn-success mr-2" style="width: 120px;">Thêm bằng cấp</div>      
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
                              <th width="15%">Tên</th>
                              <th width="15%">Chi tiết</th>
                              <th width="15%">Số người</th>
                              <th width="15%">Ngày tạo</th>
                              <th width="20%">Hoạt động</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($GetLevels as $item)
                             <tr>
                              <td>{{$idup++}}</td>

                              <td>CV{{$item->id}}</td>
                              
                              <td>
                                {{$item->qualification_name}}
                              </td>
                              <td>
                                @if($item->note == null)
                                Not update
                                @else
                                {{$item->note}}
                                @endif
                                
                              </td>
                              <td>
                                @php
                                $countSteff = 0;
                                @endphp

                                @foreach($getUsers as $count)
                                @if($item->id == $count->level)
                                @php
                                $countSteff++;
                                @endphp
                                @endif
                                @endforeach 
                                
                                {{$countSteff}}
                                
                              </td>
                              <td>
                               {{\Carbon\Carbon::parse($item->created)->format('d/m/Y')}}
                             </td>

                             <td>
                              <a href="{{url('admin/level-management/see-employee')."/".$item->id}}">
                                <button class="btn bg mr-2 text-white">Xem người dùng</button>
                              </a>
                              <a href="{{url('admin/level-management/edit')."/".$item->id}}">
                                <button class="btn btn-danger mr-2">Sửa</button>
                              </a>
                              
                              <button class="btn btn-success"  data-toggle="modal" data-target="#exampleModalUnLock{{$item->id}}">Xóa</button>                     
                            </td>
                          </tr>

                          <div class="modal fade mt-5" id="exampleModalUnLock{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Xóa bằng cấp</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                 <p>Bạn đồng ý Xóa bằng cấp {{$item->qualification_name}}?</p>
                               </div>
                               <div class="p-2">
                                 <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Hủy bỏ</button>
                                 <a  href="{{url('admin/level-management/delete')."/".$item->id}}">
                                  <button type="button" class="btn btn-danger float-right mr-2">
                                  Xóa bỏ                
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
           {{ $GetLevels->links('pagination::bootstrap-4') }}
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











