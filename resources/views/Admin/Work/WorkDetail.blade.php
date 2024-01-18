@extends("Admin.Layouts.Master")
@section('Title', 'Job Information')
@section('Content')
<style type="text/css">
  .comments {
    margin: 30px auto;
    width: 80%;
    border-left: solid 2px #ccc;
    padding: 0px 20px 0px 20px;
} .comments p {
    background-color: #fff;
    padding: 10px;
    font-size: 16px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border: solid 1px #ccc;
    line-height: 1.7;
    position: relative;
}
p::before {
    content: '';
    position: absolute;
    width: 10px;
    height: 10px;
    display: block;
    border: 3px solid #ccc;
    border-radius: 50%;
    background-color: #4B49AC;
    top: 10px;
    left: -30px;
}
p::after {
    content: '';
    position: absolute;
    border: solid 8px;
    border-color: transparent #ccc transparent transparent;
    top: 10px;
    left: -17px;
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
      <div class="content-wrapper px-0 py-3">
        <div class="row m-0">
          <div class="col-md-12 grid-margin p-0">
            <div class="row m-0">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0 p-0">
                <div>
                  <div class="bg-white p-2">
                   <h5 class="card-title mb-4 font-weight-bold mt-2 tx">Job Information</h5>
                   <p><i class="fa fa-briefcase mr-2 tx" aria-hidden="true"></i>{{$GetWork->work_name}} - {{$GetWork->note}} - @if($GetWork->status == 0)
                              Processing
                               @else
                                <Finished
                               @endif</p>
                   
                   <div class="comments">
                    @foreach($GetWorkDetail as $item)
                    <p>{{\Carbon\Carbon::parse($item->created_at)->format('Y/m/d h:i')}} - {{$item->content}}</p>
                    @endforeach
                    
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>   
</div>
<script src="{{ asset('index/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('index/js/validate/jquery.validate.min.js') }}" ></script>
<script src="{{ asset('index/js/validate/validate.js') }}"></script>
@endsection








