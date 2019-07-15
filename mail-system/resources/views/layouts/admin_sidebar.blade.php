
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <span class="brand-text font-weight-light"><strong>BKM express </strong>| Cabang</span>
    </a>

    @php
    $BkmUser = Auth::user()->getBkmUser();
    @endphp


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ $BkmUser->photo }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $BkmUser->name }}</a>
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
               <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-envelope-o"></i>
                  <p>
                    Mailbox
                    <i class="fa fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('mail-inbox') }}" class="nav-link {{{ (str_contains(request()->url(), route('mail-inbox')) ? 'active' : '') }}}">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Inbox</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('mail-compose') }}" class="nav-link {{{ (str_contains(request()->url(), route('mail-compose')) ? 'active' : '') }}}">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Compose</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('mail-outbox') }}" class="nav-link {{{ (str_contains(request()->url(), route('mail-outbox')) ? 'active' : '') }}}">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>Sent Items</p>
                    </a>
                  </li>
                </ul>
              </li>
          
          <li class="nav-item has-treeview">
            <a href="{{ config('constants.PROVIDER') }}/logout?continue={{ route('welcome') }}" class="nav-link">
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