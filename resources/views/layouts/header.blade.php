<header class="header header-sticky mb-4">
        <div class="container-fluid">
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="if (!window.__cfRLUnblockHandlers) return false; coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()" data-cf-modified-de208106593c1661e843c327-="">
            <svg class="icon icon-lg">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button><a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg></a>
          <ul class="header-nav d-none d-md-flex">
           <!--  <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li> -->
          </ul>
          <ul class="header-nav ms-auto">
            <i class="fa-solid fa-bars-progress nav-icon" style="color: #fff;"></i> 
          </ul>
          <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="{{ asset('assets/images/male-avatar.png') }}" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-light py-2">
                  <div class="fw-semibold">Account</div>
                </div>

                <a class="dropdown-item" href="#">
                  <i class="fa-solid fa-bell" ></i>
                  Notices
                  <span class="badge badge-sm bg-success ms-2">
                   42
                  </span>
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fa-solid fa-bars-progress" ></i>
                  My Projects
                  <span class="badge badge-sm bg-primary ms-2">
                    42
                  </span>
                </a>

                <div class="dropdown-header bg-light py-2">
                  <div class="fw-semibold">Settings</div>
                </div>
                <a class="dropdown-item" href="#">
                  <i class="fa-solid fa-user" ></i>
                  Profile
                </a>

                <div class="dropdown-divider"></div>

                  <a class="dropdown-item" href="#">
                    <i class="fa-solid fa-right-from-bracket" ></i>
                    Logout
                  </a>
              </div>
            </li>
          </ul>
        </div>
        
      </header>