<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <img src="{{ asset('assets/images/company-logo.png') }}" class="sidebar-brand-full" width="90" height="46" alt="TIFA Logo">
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#signet"></use>
        </svg>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fa-solid fa-gauge nav-icon" style="color: #fff;"></i> 
            Dashboard
          </a>
        </li>
        <li class="nav-title">User Management</li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fa-solid fa-user-lock nav-icon" style="color: #fff;"></i> 
            Roles
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fa-solid fa-users-gear nav-icon" style="color: #fff;"></i> 
            Users
          </a>
        </li>
        <li class="nav-title">Scripting</li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
            </svg> Tools</a>
          <ul class="nav-group-items">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('projects.index') }}">
                <i class="fa-solid fa-folder-open nav-icon" style="color: #fff;"></i> 
                Projects
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-title">
          Data Protection Module
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
            </svg> Respondents</a>
          <ul class="nav-group-items">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fa-solid fa-database nav-icon" style="color: #fff;"></i> 
                Processor
              </a>
            </li>
            <li class="nav-item" title="RDMS">
              <a class="nav-link" href="#">
                <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i> 
                Controller
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>