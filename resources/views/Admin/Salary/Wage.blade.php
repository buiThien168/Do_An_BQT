@extends("Admin.Layouts.Master")
@section('Title', 'Salary List')
@section('Content')
<style type="text/css">
    @media only screen and (max-width: 900px) {
        td {
            white-space: nowrap;
        }
    }
</style>
<div class="container-scroller">
    <x-admin.layouts.header-dashboard />
    <div class="container-fluid page-body-wrapper">
        <div class="theme-setting-wrapper">
        </div>
        <div class="sidebar sidebar-offcanvas">
            <x-admin.layouts.side-bar />
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
                                                        <h5 class="card-title float-left mb-2 tx">Danh sách bảng lương</h5>
                                                        <div class="float-right">
                                                            <form method="get">
                                                                <div class="form-group mb-3" style="display: flex">
                                                                    <input type="text" class="form-control" placeholder="Name" name="keyword">
                                                                    <button type="submit" class="btn bg text-white ml-2" style="width: 120px;">Tìm kiếm</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div style="clear: both;"></div>
                                                        <div class="mb-3 font-weight-bold">Tháng  {{$month}}</div>
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-striped">
                                                                <thead>
                                                                    <th width="3%">#</th>
                                                                    <th width="5%">Mã NV</th>
                                                                    <th width="10%">Tên</th>
                                                                    <th width="10%">Chức vụ</th>
                                                                    <th width="9%">Lương cơ bản</th>
                                                                    <th width="9%">Hỗ trợ</th>
                                                                    <th width="9%">Bảo hiểm</th>
                                                                    <th width="9%">Tiền thưởng</th>
                                                                    <th width="9%">Tiền Phạt</th>
                                                                    <th width="9%">Số công</th>
                                                                    <th width="9%">Tổng</th>
                                                                    <th width="20%">Hoạt động</th>
                                                                </thead>
                                                                <tbody>
                                                                    <p style="display: none">{{$idup = 1}}</p>
                                                                    @foreach($Wage as $item)
                                                                    <tr>
                                                                        <td>{{$idup++}}</td>
                                                                        <td>L{{$item->id}}</td>
                                                                        <td>
                                                                            {{$item->full_name}}
                                                                        </td>
                                                                        <td>
                                                                            {{$item->name_position}}
                                                                        </td>
                                                                        <td>
                                                                            @if($item->basic_salary == null)
                                                                            Not update
                                                                            @else
                                                                            {{number_format($item->basic_salary)}} VND
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            {{number_format($item->perk_salary)}} VND
                                                                        </td>
                                                                        <td>
                                                                            {{number_format($item->insuranc_salary)}} VND
                                                                        </td>
                                                                        <td>
                                                                            {{number_format($item->total_bonuses)}} VND
                                                                        </td>
                                                                        <td>
                                                                            {{number_format($item->total_disciplines)}} VND
                                                                        </td>
                                                                        <td>{{$item->total_work_month}} / tháng</td>
                                                                        <td>
                                                                            @if($item->total_work_month === $currentMonthDays)
                                                                            {{ number_format($item->total_bonuses + $item->total_disciplines + 
                                                                                $item->perk_salary +
                                                                                $item->insuranc_salary +
                                                                                $item->basic_salary) }} VND
                                                                            @else
                                                                            <?php
                                                                            $daily_salary = $item->basic_salary / $currentMonthDays; 
                                                                            $salary = $daily_salary * $item->total_work_month;
                                                                            
                                                                            
                                                                            $total_salary = ($salary +  
                                                                            $item->total_bonuses + 
                                                                            $item->perk_salary) - 
                                                                            $item->insuranc_salary - 
                                                                            $item->total_disciplines

                                                                            ;
                                                                            echo number_format($total_salary) . " VND";
                                                                            ?>
                                                                            @endif
                                                                        
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <label class="form-check-label">
                                                                                    <input 
                                                                                    class="checkbox" type="checkbox" 
                                                                                    name="email_notification"
                                                                                    data-toggle="modal"
                                                                                    data-target="#exampleModalSendMail{{$item->id}}"
                                                                                    id="checkboxs"
                                                                                    >
                                                                                    Gửi thông báo
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <div class="modal fade mt-5" id="exampleModalSendMail{{$item->id}}" tabindex="-1" role="dialog"
                                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Gửi email tới {{$item->full_name}}?</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form method="post" action="{{url('admin/salary-management/send_mail')."/".$item->id}}">
                                                                                        @csrf
                                                                                        <div class="row m-0">
                                                                                            <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                                                                                                <label class="fz85">Lương cơ bản</label>
                                                                                                <input type="text" name="basic_salary" class="form-control mr-2"
                                                                                                    value="{{ $item->basic_salary != null ? $item->basic_salary : ""}}" autocomplete="off"
                                                                                                    required>
                                                                                            </div>
                                                                                            <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                                                                                                <label class="fz85">Hỗ trợ</label>
                                                                                                <input type="text" name="perk_salary" class="form-control mr-2"
                                                                                                    value="{{ $item != null ? $item->perk_salary : ""}}" autocomplete="off" required>
                                                                                            </div>
                                                                                            <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                                                                                                <label class="fz85">Bảo hiểm</label>
                                                                                                <input type="text" name="insuranc_salary" class="form-control mr-2"
                                                                                                    value="{{ $item != null ? $item->insuranc_salary : ""}}" autocomplete="off" required>
                                                                                            </div>
                                                                                            <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                                                                                                <label class="fz85">Tiền thưởng</label>
                                                                                                <input type="text" name="total_bonuses" class="form-control mr-2"
                                                                                                    value="{{ $item != null ? $item->total_bonuses : ""}}" autocomplete="off" required>
                                                                                            </div>
                                                                                            <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                                                                                                <label class="fz85">Tiền phạt</label>
                                                                                                <input type="text" name="total_disciplines" class="form-control mr-2"
                                                                                                    value="{{ $item != null ? $item->total_disciplines : ""}}" autocomplete="off" required>
                                                                                            </div>
                                                                                            <div class="col-12 col-sm-6 col-md-4 p-0 px-2 mb-2">
                                                                                                <label class="fz85">Số công</label>
                                                                                                <input type="text" name="total_work_month" class="form-control mr-2"
                                                                                                    value="{{ $item != null ? $item->total_work_month : ""}}" autocomplete="off" required>
                                                                                            </div>
                                                                                            <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                                                                                                <button class="btn bg text-white">Gửi</button>
                                                                                              </div>
                                                                                        </div>   
                                                                                    </form>
                                                                                    <div style="clear: both"></div>
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
    @endsection