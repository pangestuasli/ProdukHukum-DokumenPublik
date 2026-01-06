<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <!-- LOGO UTAMA -->
    <a class="navbar-brand brand-logo me-5" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/images/logo/logo.png') }}" 
           alt="{{ config('app.name', 'Laravel') }}"
           style="height: 40px; width: auto;" />
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    
    <!-- Search Bar -->
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <span class="input-group-text" id="search">
              <i class="icon-search"></i>
            </span>
          </div>
          <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
    
    <ul class="navbar-nav navbar-nav-right">
      <!-- Notifications Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
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
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Application Error</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> Just now </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="ti-settings mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Settings</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> Private message </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <i class="ti-user mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">New user registration</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> 2 days ago </p>
            </div>
          </a>
        </div>
      </li>
      
      <!-- Profile Dropdown -->
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          @auth
            @php
                // Cek apakah user punya foto profil
                $user = Auth::user();
                $photoUrl = $user->profil_picture 
                    ? asset('storage/profil/' . $user->profil_picture)
                    : asset('skydash/images/faces/face28.jpg');
            @endphp
            <img src="{{ $photoUrl }}" 
                 alt="{{ $user->name }}"
                 class="rounded-circle"
                 style="width: 36px; height: 36px; object-fit: cover;" />
            <span class="ms-2 d-none d-lg-inline">{{ $user->name }}</span>
          @else
            <img src="{{ asset('skydash/images/faces/face28.jpg') }}" 
                 alt="Guest"
                 class="rounded-circle"
                 style="width: 36px; height: 36px; object-fit: cover;" />
          @endauth
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          @auth
            @php
                $user = Auth::user();
                $photoUrl = $user->profil_picture 
                    ? asset('storage/profil/' . $user->profil_picture)
                    : asset('skydash/images/faces/face28.jpg');
            @endphp
            
            <!-- Header dengan Foto & Info User -->
            <div class="dropdown-header text-center py-3">
              <img src="{{ $photoUrl }}" 
                   class="img-sm rounded-circle mb-2" 
                   alt="{{ $user->name }}" 
                   style="width: 50px; height: 50px; object-fit: cover;" />
              <p class="mb-1 font-weight-semibold">{{ $user->name }}</p>
              <p class="font-weight-light text-muted mb-0" style="font-size: 0.875rem;">
                {{ $user->email }}
              </p>
            </div>
            <div class="dropdown-divider"></div>
            
            <!-- Menu Items -->
            <a class="dropdown-item" href="{{ url('/') }}">
              <i class="ti-home text-primary me-2"></i> Dashboard
            </a>
            
            <!-- Jika user admin, tambahkan link ke user management -->
            @if($user->role == 'admin')
            <a class="dropdown-item" href="{{ route('user.index') }}">
              <i class="ti-user text-primary me-2"></i> Manage Users
            </a>
            @endif
            
            <a class="dropdown-item" href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="ti-power-off text-primary me-2"></i> Logout
            </a>
            
            <!-- Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          @else
            <!-- Menu untuk Guest -->
            <a class="dropdown-item" href="{{ route('login') }}">
              <i class="ti-lock text-primary me-2"></i> Login
            </a>
          @endauth
        </div>
      </li>
      
      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="icon-ellipsis"></i>
        </a>
      </li>
    </ul>
    
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>