


<nav class="sidebar sidebar-offcanvas" id="sidebar" style="position:fixed;">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#tongquan" aria-expanded="false" aria-controls="tongquan">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Quản lý tài khoản</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tongquan">
        <ul class="nav flex-column sub-menu">
          {{-- <li class="nav-item"> <a class="nav-link" href="{{url('admin/thiet-lap')}}">Thống kê</a></li> --}}
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/user-management')}}">Danh sách người dùng</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/account-management')}}">Quản lý tài khoản</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#nhanvien" aria-expanded="false" aria-controls="nhanvien">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Quản lý nhân sự</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="nhanvien">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/department-manager')}}">Phòng</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/position-management')}}">Bộ phận</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/level-management')}}">Trình độ chuyên môn</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/professional-management')}}">Chuyên môn hóa</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/manage-employee-type')}}">Loại nhân viên</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/educational-management')}}">Trình độ học vấn</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/contract-management')}}">Hợp đồng</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#salary" aria-expanded="false" aria-controls="salary">
        <i class="ti-wallet menu-icon"></i>
        <span class="menu-title">Quản lý tiền lương</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="salary">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/salary-management')}}">Lương cơ bản</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/salary-management/wage')}}">Bảng lương</a></li> 
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#schedule" aria-expanded="false" aria-controls="schedule">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Quản lý lịch trình</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="schedule">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/schedule/payroll')}}">Chấm công</a></li>  
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/take-leave')}}">Xin nghỉ</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#congviec" aria-expanded="false" aria-controls="congviec">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Quản lý công việc</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="congviec">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/workflow-management')}}">Công việc</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#khenthuong" aria-expanded="false" aria-controls="khenthuong">
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">Kỷ luật khen thưởng</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="khenthuong">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/bonus')}}">Thưởng</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/discipline')}}">Kỷ luật</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#taikhoan" aria-expanded="false" aria-controls="taikhoan">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Tài khoản</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="taikhoan">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/account-information')}}">Thông tin tài khoản</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/change-password')}}">Đổi mật khẩu</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/identity-management')}}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Quản lý danh tính</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#email-campagn" aria-expanded="false" aria-controls="email-campagn">
        <i class="icon-ban menu-icon"></i>
        <span class="menu-title">Quản lý email</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="email-campagn">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/email-marketing/email-template')}}">Mẫu email</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/email-marketing/email-config')}}">Cấu hình email</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/email-marketing/send-mail/add')}}">Gửi mail</a></li>
          
        </ul>
      </div>
    </li>


  </ul>
</nav>
