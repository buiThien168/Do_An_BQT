@extends("Staff.Layouts.Master")
@section('Title', 'List of Rewards')
@section('Content')
<style type="text/css">
    @media only screen and (max-width: 900px) {
        td {
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
            <div class="content-wrapper p-0">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="col-12 col-xl-12 mb-4 mb-xl-0 ">
                            <div class="bg-white p-2 mt-2">
                                <div id='calendar'></div>
                            </div>
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