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
<!-- Modal -->
<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Chấm công</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="selectOption">Điểm danh:</label>
                    <select class="form-control" id="selectOption" name="selectOption">
                        <option value="0" selected>Điểm danh</option>
                        <option value="1">Xin nghỉ</option>
                    </select>
                </div>
                {{-- diểm danh --}}
                <div style="display: block" id="attendes">
                    <div class="form-group" >
                        <label for="inputAttendes">Nội dung công việc</label>
                        <input type="text" class="form-control" id="inputAttendes" name="inputAttendes"
                            placeholder="Nội dung công việc thực hiện trong ngày..">
                    </div>
                </div>
                {{-- xin nghỉ --}}
                <div style="display: none" id="breaks">
                    <div class="form-group">
                        <label for="selectBreaks">Thời gian nghỉ:</label>
                        <select class="form-control" id="selectBreaks" name="selectBreaks">
                            <option value="1">Cả ngày</option>
                            <option value="2">Nửa buổi</option>
                        </select>
                    </div>
                    <div class="form-group" >
                        <label for="inputBreaks">Lý do nghỉ:</label>
                        <input type="text" class="form-control" id="inputBreaks" name="inputBreaks"
                            placeholder="Lý do nghỉ">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="submitBtn" onclick="submitForm()">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection