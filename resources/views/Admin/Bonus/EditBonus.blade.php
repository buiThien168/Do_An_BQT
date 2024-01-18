@extends("Admin.Layouts.Master")
@section('Title', 'Update Bonus')
@section('Content')
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
                   <h5 class="card-title mb-4 font-weight-bold ml-2 mt-2 tx">Update Bonus</h5>
                   <form  method="post" action="{{url('admin/bonus/edit')."/".$id}}">
                    @csrf
                    <div class="row m-0">
                     <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                      <label class="fz85">Detail</label>
                      <input type="text" name="note" class="form-control mr-2" autocomplete="off"  value="{{ $getBonus != null ? $getBonus->note : ""}}" required>
                    </div> 
                    <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                      <label class="fz85">Bonus Level</label>
                      <input type="text" name="value" class="form-control mr-2" value="{{ $getBonus != null ? $getBonus->value : ""}}" autocomplete="off" required>
                    </div>  


                    <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                      <button class="btn bg text-white">Update Bonus</button>
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








