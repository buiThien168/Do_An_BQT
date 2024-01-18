@extends("Staff.Layouts.Master")
@section('Title', 'Job')
@section('Content')
<div class="container-scroller">
  <x-staff.layouts.header-dashboard/>
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
    </div>
    <div class="side-bar-box" style="width: 250px;">
      <x-staff.layouts.side-bar/>
    </div>
    <div class="main-panel">
      <div class="content-wrapper px-0 py-3">
        <div class="row m-0">
          <div class="col-md-12 grid-margin p-0">
            <div class="row m-0">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0 p-0">
                <div>
                  <div class="bg-white p-2">
                   <h5 class="card-title mb-4 font-weight-bold ml-2 mt-2 tx">Job</h5>

                   <form id="form-add-department" method="post" action="{{url('workflow-management/update-progress')."/".$id}}">
                    @csrf
                    <div class="row m-0">  
                      <div class="col-12 col-sm-12 col-md-12 p-0 px-2 mb-2">
                        <label class="fz85">Work progress</label>
                        <textarea class="form-control mr-2" name="work_progress" required>

                        </textarea>
                        
                      </div> 
                      
                      <div class="col-12 p-0 pr-2 mb-2 text-center mt-3 d-flex">
                        <button class="btn bg text-white mr-2">Update progress</button>
                        <a href="{{url('workflow-management/complete-the-work')."/".$id}}">
                          <div class="btn bg text-white">Complete</div>
                        </a>
                      </div>
                    </div>
                  </form>
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








