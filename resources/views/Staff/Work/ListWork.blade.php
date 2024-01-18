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
    <div class="side-bar-box" style="width: 250px;">
      <x-staff.layouts.side-bar/>
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
                         <h5 class="card-title float-left mb-2 tx">Work list</h5>
                         
                         <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <thead>
                              <th width="3%">#</th>
                              <th width="4%">Code</th>
                              
                              <th width="18%">Job</th>
                              <th width="18%">Date</th>
                              <th width="10%">Status</th>
                              <th width="10%">Date created</th>
                              <th width="24%">Operation</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($GetWork as $item)
                             <tr>
                              <td>{{$idup++}}</td>
                              <td>KT{{$item->id}}</td>
                              
                              <td>
                                {{$item->work_name}}
                              </td>
                              <td>
                               From {{\Carbon\Carbon::parse($item->from)->format('d/m/Y')}} To {{\Carbon\Carbon::parse($item->to)->format('d/m/Y')}}
                             </td>
                             <td>
                               @if($item->status == 0)
                               <span class="text-warning">Processing</span>
                               @else
                               <span class="text-success">Finished</span>
                               @endif
                             </td>
                             <td>
                               {{\Carbon\Carbon::parse($item->created)->format('d/m/Y')}}
                             </td>
                             <td>
                              <a href="{{url('workflow-management/job-details')."/".$item->id}}">
                                <button class="btn btn-success mr-2 text-white">See</button>
                              </a>
                              @if($item->status == 0)
                              <a href="{{url('workflow-management/update-progress')."/".$item->id}}">
                                <button class="btn btn-success mr-2 text-white">Update progress</button>
                              </a>                       
                              @endif         
                            </td>
                          </tr>

                          <div class="modal fade mt-5" id="exampleModalUnLock{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Employee Type</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                 <p>You Agree Delete Job?</p>
                               </div>
                               <div class="p-2">
                                 <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancel</button>
                                 <a  href="{{url('admin/workflow-management/delete')."/".$item->id}}">
                                  <button type="button" class="btn btn-danger float-right mr-2">
                                    Delete                
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











