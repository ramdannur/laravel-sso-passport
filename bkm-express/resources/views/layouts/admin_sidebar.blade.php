
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <span class="brand-text font-weight-light"><strong>BKM express </strong>| Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->profile->getAvatarUrlAttribute() }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ route('home') }}" class="nav-link {{{ (str_contains(request()->url(), route('home')) ? 'active' : '') }}}">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('user-index') }}" class="nav-link {{{ (str_contains(request()->url(), route('user-index')) ? 'active' : '') }}}">
              <i class="nav-icon fa fa-table"></i>
              <p>
                Users Data
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('branch-index') }}" class="nav-link {{{ (str_contains(request()->url(), route('branch-index')) ? 'active' : '') }}}">
              <i class="nav-icon fa fa-table"></i>
              <p>
                Branch Data
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('agency-index') }}" class="nav-link {{{ (str_contains(request()->url(), route('agency-index')) ? 'active' : '') }}}">
              <i class="nav-icon fa fa-table"></i>
              <p>
                Agency Data
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('delivery-index') }}" class="nav-link {{{ (str_contains(request()->url(), route('delivery-index')) ? 'active' : '') }}}">
              <i class="nav-icon fa fa-table"></i>
              <p>
                Delivery Transaction
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>