<nav class="sidebar sidebar-offcanvas" id="sidebar" style="position:fixed;">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#tongquan" aria-expanded="false" aria-controls="tongquan">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Tài khoản</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tongquan">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('account-information')}}">Thông tin tài khoản</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('change-password')}}">Đổi mật khẩu</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('workflow-management')}}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Quản lý công việc</span>
      </a>
    </li>
    <li class="nav-item">
      {{-- <a class="nav-link" href="{{url('attendance')}}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Điểm danh</span>
      </a> --}}
      <a class="nav-link" data-toggle="collapse" href="#diemdanh" aria-expanded="false" aria-controls="diemdanh">
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">Điểm danh</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="diemdanh">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('/time-keeping')}}">Điểm danh khuân mặt</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('/attendance')}}">Điểm danh</a></li>
          
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('salary-management')}}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Quản lý tiền lương</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#khenthuong" aria-expanded="false" aria-controls="khenthuong">
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">Kỷ luật khen thưởng</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="khenthuong">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('bonus')}}">Thưởng</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('discipline')}}">Kỷ luật</a></li>
          
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('identity-management')}}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Quản lý danh tính</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('register-faces')}}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Đăng ký khuôn mặt</span>
      </a>
    </li>
  </ul>
</nav>
