<!-- ========================= header-2 start ========================= -->
<header class="header header-2">
  <div class="navbar-area">
    <div class="container">
      <nav class="navbar navbar-expand-lg">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
          <img 
            src="{{ asset('assets/img/logo/image.png') }}" 
            alt="Logo" 
            height="40"
          />
          <h4 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Produk Hukum & Dokumen Publik</h4>
        </a>
        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse"
          data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="toggler-icon"></span>
          <span class="toggler-icon"></span>
          <span class="toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent2">
          <ul class="navbar-nav ml-auto">

                      <li class="nav-item">
                        <a class="page-scroll active" href={{ 'dashboard' }}>Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll active" href="#PusatData">Pusat Data</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll active" href="#contact">Contact</a>
                      </li>
          </ul>
        </div>

      </nav>
    </div>
  </div>
</header>
<!-- ========================= header-2 end ========================= -->
