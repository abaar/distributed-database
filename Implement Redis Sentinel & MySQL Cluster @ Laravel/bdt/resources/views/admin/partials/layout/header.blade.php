<header class="app-header navbar">
  <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#"></a>

  {{-- <a class="navbar-brand" style="background: none; padding-left: 20px; padding-top: 15px">TRYOUT SBMPTN</a> --}}
  
  <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
    <span class="navbar-toggler-icon"></span>
  </button>

  <ul class="nav navbar-nav d-md-down-none">
    <li class="nav-item px-3">
      <a class="nav-link" href="#">Dashboard</a>
    </li>
    <li class="nav-item px-3">
      <a class="nav-link" href="#">Users</a>
    </li>
    <li class="nav-item px-3">
      <a class="nav-link" href="#">Settings</a>
    </li>
  </ul>
  <ul class="nav navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <img src="{{url('assets/img/user-placeholder.png')}}" class="img-avatar" alt="admin@bootstrapmaster.com">
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header text-center">
          <strong>Settings</strong>
        </div>
        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
        <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
        <a class="dropdown-item" href="{{route('admin.auth.logout')}}"><i class="fa fa-lock"></i> Logout</a>
      </div>
    </li>
  </ul>
</header>