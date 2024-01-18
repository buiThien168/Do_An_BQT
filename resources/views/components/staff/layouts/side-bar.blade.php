<nav class="sidebar sidebar-offcanvas" id="sidebar" style="position:fixed;">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#tongquan" aria-expanded="false" aria-controls="tongquan">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Account</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tongquan">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('account-information')}}">Account information</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('change-password')}}">Change Password</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('workflow-management')}}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Workflow management</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{url('salary-management')}}">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Salary Management</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#khenthuong" aria-expanded="false" aria-controls="khenthuong">
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">Reward-discipline</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="khenthuong">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('bonus')}}">Bonus</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('discipline')}}">Discipline</a></li>
          
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('identity-management')}}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Identity management</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('register-faces')}}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Face registration</span>
      </a>
    </li>
  </ul>
</nav>
