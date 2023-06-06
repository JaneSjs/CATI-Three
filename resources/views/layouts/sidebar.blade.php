<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <img src="{{ asset('assets/images/company-logo.png') }}" class="sidebar-brand-full" width="90" height="46" alt="TIFA Logo">
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">

        <li class="nav-item">
          <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="fa-solid fa-gauge nav-icon" style="color: #fff;"></i> 
            Dashboard
          </a>
        </li>
        @canany(['admin','head','ceo'])
        <li class="nav-title">User Management</li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fa-solid fa-user-lock nav-icon" style="color: #fff;"></i> 
            User Roles
          </a>
        </li>
        @elseif(auth()->user()->id == 1)
        <li class="nav-title">User Management</li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fa-solid fa-user-lock nav-icon" style="color: #fff;"></i> 
            User Roles
          </a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fa-solid fa-users-gear nav-icon" style="color: #fff;"></i> 
            Users
          </a>
        </li>
        <li class="nav-title">
          Projects
        </li>

        @canany(['admin','head','ceo'])
        <li class="nav-item">
          <a class="nav-link" href="{{ route('projects.index') }}">
            <i class="fa-solid fa-folder-open nav-icon" style="color: #fff;"></i> 
            All Projects
          </a>
        </li>
        @endcan

        @canany(['manager','scripter'])
        <li class="nav-item">
          <a class="nav-link" href="{{ route('projects.index') }}">
            <i class="fa-solid fa-folder-open nav-icon" style="color: #fff;"></i> 
            My Projects
          </a>
        </li>
        @endcan

        @canany(['supervisor','agent','qc'])
        <li class="nav-item">
          <a class="nav-link" href="{{ route('projects.index') }}">
            <i class="fa-solid fa-folder-open nav-icon" style="color: #fff;"></i> 
            My Assigned Projects
          </a>
        </li>
        @endcan
        
        @canany('admin','ceo','head','manager','scripter')
        <li class="nav-title">
          Data Protection Module
        </li>
        <li class="nav-group">
          <a class="nav-link nav-group-toggle" href="#">
             Respondents
           </a>
          <ul class="nav-group-items">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fa-solid fa-database nav-icon" style="color: #fff;"></i> 
                Data Processing
              </a>
            </li>
            <li class="nav-item" title="RDMS">
              <button type="button" class="nav-link" title="RDMS" data-coreui-toggle="modal" data-coreui-target="#rdms">
                <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i>
                Data Controlling
              </button>
            </li>
          </ul>
        </li>
        @endcan
      </ul>
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>

    <!-- RDMS Modal -->
    <div class="modal fade" id="rdms" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="rdmsLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-light" id="rdmsLabel">
              <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i>
              RDMS
            </h5>
            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body bg-warning">
            Controlled database is managed from the RDMS system
            <a href="https://rdms.tifaresearch.com/" target="_blank" class="btn btn-outline-primary text-dark float-end">
              Go To RDMS ?
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- End RDMS Modal -->
