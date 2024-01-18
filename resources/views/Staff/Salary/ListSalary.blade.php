@extends("Staff.Layouts.Master")
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
                         <h5 class="card-title float-left mb-2 tx">Salary List</h5>
                         <div class="float-right"> 
                          <div class="d-flex">
                            <p>Wage: {{number_format($GetSalary)}}$ |</p>
                            <p>| Total working hours: {{$time}} |</p>
                            <p>| Temporary salary: {{number_format($salary)}}$</p>
                          </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <thead>
                              <th width="3%">#</th>
                              <th width="20%">Date</th>
                              <th width="20%">Hour in</th>
                              <th width="20%">Hour out</th>
                              <th width="20%">Recording time</th>
                              <th width="27%">Temporary salary</th>
                            </thead>
                            <tbody>
                             <p style="display: none">{{$idup = 1}}</p>
                             @foreach($checktime as $item)
                             <tr>
                              <td>{{$idup++}}</td>
                              <td>
                                {{\Carbon\Carbon::parse($item['checkin'])->setTimezone('America/Los_Angeles')->format('d/m/Y')}}
                              </td>
                              <td>
                               {{\Carbon\Carbon::parse($item['checkin'])->setTimezone('America/Los_Angeles')->format('H:i')}}
                             </td>
                             <td>
                              {{\Carbon\Carbon::parse($item['checkout'])->setTimezone('America/Los_Angeles')->format('H:i')}}
                            </td>
                            <td>
                             {{$item['time']}}
                           </td>
                           <td>
                            {{number_format($item['salary'])}}$
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











