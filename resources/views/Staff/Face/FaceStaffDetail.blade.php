@extends("Staff.Layouts.Master")
@section('Title', 'Dữ liệu nhận diện')
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
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                <div>
                  <div>
                    <div class="row m-0">
                      @forelse($getImages as $item)
                      <div class="col-2">
                        <div class="shadow-sm p-2 bg-white">
                          <img src="{{ asset('storage/public/face-data')."/".$item->name."/".$item->image}}" width="100%">
                        </div>
                      </div>
                      @empty
                      <span>No data yet</span>
                      @endforelse
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
  @endsection






