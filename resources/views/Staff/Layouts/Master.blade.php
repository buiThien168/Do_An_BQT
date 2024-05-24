<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('Title')</title>
  @section('styles_')
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('js/theme-manage/select.dataTables.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/theme-manage/style.css')}}">
  <link rel="stylesheet" href="{{ asset('Index/css/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" integrity="sha512-72McA95q/YhjwmWFMGe8RI3aZIMCTJWPBbV8iQY3jy1z9+bi6+jHnERuNrDPo/WGYEzzNs4WdHNyyEr/yXJ9pA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
</head>

<body style="background:#F5F7FF">
  <style type="text/css">
    @media only screen and (max-width: 991px) {
      .side-bar-box {
        width: 0% !important;
      }

    }

    @media only screen and (max-width: 770px) {
      .col-12 {
        padding: 0 !important;
      }
    }

    .table td {
      line-height: 20px;
    }
  </style>
  @section('Content')
  @show
</body>
<!-- plugins:js -->
<script src="{{ asset('vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('vendors/chart.js/Chart.min.js')}}"></script>
{{-- <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js')}}"></script> --}}
<script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('js/theme-manage/dataTables.select.min.js')}}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('js/theme-manage/off-canvas.js')}}"></script>
<script src="{{ asset('js/theme-manage/hoverable-collapse.js')}}"></script>
<script src="{{ asset('js/theme-manage/template.js')}}"></script>
<script src="{{ asset('js/theme-manage/settings.js')}}"></script>
<script src="{{ asset('js/theme-manage/todolist.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('js/theme-manage/dashboard.js')}}"></script>
<script src="{{ asset('js/theme-manage/Chart.roundedBarCharts.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="{{ asset('js/calender/calender.js')}}"></script>
<!-- End custom js for this page-->
@section('js')
</html>