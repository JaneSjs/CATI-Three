<header class="header header-sticky mb-4">
  <div class="container-fluid">
    <button class="header-toggler px-md-0 me-md-3" type="button" onclick="if (!window.__cfRLUnblockHandlers) return false; coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()" data-cf-modified-de208106593c1661e843c327-="">
      <i class="fas fa-bars"></i>
    </button>
    <a class="header-brand d-md-none" href="#">
      <img src="{{ asset('assets/images/company-logo.png') }}" alt="TIFA Logo" height="50px" width="50px">
    </a>

    

    <ul class="header-nav d-none d-md-flex">
      @can('admin')
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/log-reader') }}">
          System Logs
        </a>
      </li>
      @endcan
      @if(request()->segment(1) !== 'begin_survey')
        <li class="nav-item bg-warning" title="Go To Previous Page">
          <a class="nav-link" href="{{ url()->previous() }}">
            &laquo;
            Back
          </a>
        </li>
      @endif
    </ul>
        
    <ul class="header-nav ms-auto">
      <i class="fa-solid fa-bars-progress nav-icon" style="color: #fff;"></i> 
    </ul>

    <ul class="header-nav ms-3">
      <li class="nav-item dropdown">
        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fa-solid fa-bell"></i>
        </a>
      </li>
    </ul>
    @if(request()->segment(1) !== 'begin_survey')
      <ul class="header-nav ms-3">
        <li class="nav-item dropdown">
          <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-md">
              <img class="avatar-img" src="{{ asset('assets/images/male-avatar.png') }}" alt="{{ auth()->user()->email }}">
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end pt-0">
            <div class="dropdown-header bg-light py-2">
              <div class="fw-semibold">
                {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} ({{ auth()->user()->id }})
              </div>
              <p class="d-none" id="username">
                {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
              </p>
            </div>

            <a class="dropdown-item" href="#" disabled>
              <i class="fas fa-bell" ></i>
              Notices
              <span class="badge badge-sm bg-success ms-2">
               42
              </span>
            </a>
            <a class="dropdown-item" href="{{ route('projects.index') }}">
              <i class="fas fa-bars-progress" ></i>
              My Projects
            </a>

            <div class="dropdown-header bg-light py-2">
              <div class="fw-semibold">Settings</div>
            </div>
            <a class="dropdown-item" href="{{ route('profiles.show', auth()->user()->id) }}">
              <i class="fa-solid fa-user" ></i>
              Profile
            </a>

            <div class="dropdown-divider"></div>

            <form action="{{ route('logout') }}" method="post">
              @csrf
              <div class="dropdown-item">
                <i class="fas fa-right-from-bracket fa-fade" ></i>
                <button type="submit" class="btn btn-outline-default">
                  Logout
                </button>
              </div>
            </form>

          </div>
        </li>
      </ul>
    @endif
  </div>
        
</header>