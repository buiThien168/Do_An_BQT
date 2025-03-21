<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="tx navbar-brand brand-logo mr-5" href="{{url("/")}}" style="font-weight: bold;">ADMIN</a>
   
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
   
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="icon-bell mx-0"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="ti-info-alt mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content" onclick="window.location.href='{{url('admin/schedule/payroll')}}'">
              <h6 class="preview-subject font-weight-normal">Chấm công</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                Chi tiết chấm công
              </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="ti-user mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content" onclick="window.location.href='{{url('admin/contract-management')}}'">
              <h6 class="preview-subject font-weight-normal">Hợp đồng</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                Danh sách hợp đồng
              </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <i class="ti-settings mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Settings</h6>
              <div class="d-flex">
                <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                  <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                  <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                </div>
              </div>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          @if(Auth::user()->avatar == null)
          <img src="{{ asset('images/avatars/default-admin.png')}}" />
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{url('admin/log-out')}}">
            <i class="ti-power-off text-primary"></i>
           Logout
          </a>
        </div>
      </li>
      
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
