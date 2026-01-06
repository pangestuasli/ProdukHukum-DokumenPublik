<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Dashboard')</title>
  <meta name="description" content="@yield('description', '')" />

  <!-- ========================= CSS here ========================= -->
  @include('layouts.admin.css')
</head>

<body>
  <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

  <!-- ========================= preloader start ========================= -->
  <div class="preloader">
    <div class="loader">
      <div class="spinner">
        <div class="spinner-container">
          <div class="spinner-rotator">
            <div class="spinner-left">
              <div class="spinner-circle"></div>
            </div>
            <div class="spinner-right">
              <div class="spinner-circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ========================= preloader end ========================= -->

  <!-- ========================= hero-section-wrapper-2 start ========================= -->
  <section id="home" class="hero-section-wrapper-2">

    {{-- Header --}}
    @include('layouts.admin.header')

    <!-- ========================= hero-2 start ========================= -->
    <div class="hero-section hero-style-2">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-6">
            <div class="hero-content-wrapper">

              <h3 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Tentang Produk Hukum dan Dokumen Publik</h3>
              <p class="mb-50 wow fadeInUp" data-wow-delay=".6s">
                Produk Hukum dan Dokumen Publik merupakan kumpulan peraturan 
                perundang-undangan, keputusan, serta dokumen resmi yang diterbitkan oleh pemerintah sebagai 
                dasar hukum dalam pelaksanaan tugas, pelayanan publik, dan penyelenggaraan pemerintahan.</p>


            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-image text-center">
              <img src="{{ asset('assets/img/hero/hero-2/image.png') }}" alt="Hero Image" class="wow fadeInRight img-fluid rounded shadow" data-wow-delay=".2s" style="max-width: 150%; height: auto;">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ========================= hero-2 end ========================= -->
    <!-- ========================= feature style-2 start ========================= -->
    <section id="PusatData" class="feature-section feature-style-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-xl-7 col-lg-10 col-md-9">
                <div class="section-title mb-60">
                  <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s"> Pusat Informasi Produk Hukum dan Dokumen Publik</h3>
                  <p class="wow fadeInUp" data-wow-delay=".4s">Menyediakan akses terpusat terhadap peraturan, keputusan, dan dokumen publik
  yang akurat, terbaru, dan dapat dipertanggungjawabkan.</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="single-feature d-flex flex-column align-items-center text-center">

                  <div class="icon mb-3 d-flex justify-content-center">
                    <img src="{{ asset('assets/img/logos/Warga.png') }}" alt="Data Warga" height="80" class="img-fluid">
                  </div>

                  <h5 class="mb-2">Data Warga</h5>

                  <p class="text-muted mb-3">
                    Kelola data warga secara terpusat
                  </p>

                  <a href="{{ route('warga.index') }}" class="button radius-10">
                    Klik Disini
                  </a>

                </div>
              </div>


              <div class="col-md-6">
                <div class="single-feature d-flex flex-column align-items-center text-center">

                  <div class="icon mb-3 d-flex justify-content-center">
                    <img src="{{ asset('assets/img/logos/Folder.png') }}" alt="Jenis Dokumen" height="80" class="img-fluid">
                  </div>

                  <h5 class="mb-2">Jenis Dokumen</h5>

                  <p class="text-muted mb-3">
                    Kelola jenis dokumen dengan mudah
                  </p>

                  <a href="{{ route('jenis_dokumen.index') }}" class="button radius-10">
                    Klik Disini
                  </a>

                </div>
              </div>
              <div class="col-md-6">
                <div class="single-feature d-flex flex-column align-items-center text-center">

                  <div class="icon mb-3 d-flex justify-content-center">
                    <img src="{{ asset('assets/img/logos/kategori.png') }}" alt="Kategori Dokumen" height="80" class="img-fluid">
                  </div>

                  <h5 class="mb-2">Kategori Dokumen</h5>

                  <p class="text-muted mb-3">
                    Kelola kategori dokumen dengan mudah
                  </p>

                  <a href="{{ route('kategori-dokumen.index') }}" class="button radius-10">
                    Klik Disini
                  </a>
             </div>
              </div>
              <div class="col-md-6">
                <div class="single-feature d-flex flex-column align-items-center text-center">

                  <div class="icon mb-3 d-flex justify-content-center">
                    <img src="{{ asset('assets/img/logos/laws.png') }}" alt="Dokumen Hukum" height="80" class="img-fluid">
                  </div>

                  <h5 class="mb-2">Dokumen Hukum</h5>

                  <p class="text-muted mb-3">
                    kelola dokumen hukum dengan mudah
                  </p>

                  <a href="{{ route('dokumen-hukum.index') }}" class="button radius-10">
                    Klik Disini
                  </a>
              </div>
            </div>

          </div>
        </div>
      </div>
      
    </section>
    
    <!-- ========================= pricing style-1 end ========================= -->
    {{-- Main Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('layouts.admin.footer')

    <!-- ========================= scroll-top start ========================= -->
    <a href="#" class="scroll-top"> <i class="lni lni-chevron-up"></i> </a>
    <!-- ========================= scroll-top end ========================= -->

    <!-- ========================= JS here ========================= -->
    @include('layouts.admin.js')
</body>

</html>