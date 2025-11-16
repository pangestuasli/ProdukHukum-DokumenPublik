<!-- ========================= header-2 start ========================= -->
<header class="header header-2">
  <div class="navbar-area">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ url('/') }}">
              <img src="{{ asset('guest/img/logo/logo.svg') }}" alt="Logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent2">
              <ul id="nav2" class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="page-scroll active" href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="{{ route('warga.index') }}">Warga</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="{{ route('jenis-dokumen.index') }}">Jenis Dokumen</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#pricing">Pricing</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#contact">Contact</a>
                </li>
              </ul>
              <a href="#0" class="button button-sm radius-10 d-none d-lg-flex">Get Started</a>
            </div>
            <!-- navbar collapse -->
          </nav>
          <!-- navbar -->
        </div>
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </div>
  <!-- navbar area -->
</header>
<!-- ========================= header-2 end ========================= -->
