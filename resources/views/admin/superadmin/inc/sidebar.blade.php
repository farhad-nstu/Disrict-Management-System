  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">District Erp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <a href="{{ route('profile') }}">
          <div class="image">
            <img src="{{ asset(Auth::user()->user_picture) }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </a>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Registrations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->role == "admin")
              <li class="nav-item">
                <a href="{{ route('dcs.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>District Admin</p>
                </a>
              </li>
              @endif 
              @if(Auth::user()->role == "admin" || Auth::user()->role == "dc")
              <li class="nav-item">
                <a href="{{ route('unos.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upazilla Admin</p>
                </a>
              </li>
              @endif 
              @if(Auth::user()->role == "admin" || Auth::user()->role == "uno")
              <li class="nav-item">
                <a href="{{ route('unionParishads.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Union Admin</p>
                </a>
              </li>
              @endif 
              @if(Auth::user()->role == "admin" || Auth::user()->role == "dc")
              <li class="nav-item">
                <a href="{{ route('pouroAdmin.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pouroshava Admin</p>
                </a>
              </li>
              @endif 
              @if(Auth::user()->role == "admin" || Auth::user()->role == "mayor")
              <li class="nav-item">
                <a href="{{ route('pouro_assesors.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pouroshava Assesor Admin</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->role == "admin" || Auth::user()->role == "pouro_assesor")
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p></p>
                </a>
              </li>
              @endif
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Configuration
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->role == "admin")
              <li class="nav-item">
                <a href="{{ route('zilla.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Zilla</p>
                </a>
              </li>
              @endif 
              @if(Auth::user()->role == "admin" || Auth::user()->role == "dc")
              <li class="nav-item">
                <a href="{{ route('upazilla.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upazilla</p>
                </a>
              </li>
              @endif 
              @if(Auth::user()->role == "admin" || Auth::user()->role == "dc")
              <li class="nav-item">
                <a href="{{ route('pouroshava.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pouroshava</p>
                </a>
              </li>
              @endif 
              @if(Auth::user()->role == "admin" || Auth::user()->role == "uno")
              <li class="nav-item">
                <a href="{{ route('union.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Union</p>
                </a>
              </li>
              @endif 
              @if(Auth::user()->role == "admin" || Auth::user()->role == "mayor")
              <li class="nav-item">
                <a href="{{ route('ward.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ward</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->role == "admin")
              <li class="nav-item">
                <a href="{{ route('module.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Module</p>
                </a>
              </li>
              @endif 
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>