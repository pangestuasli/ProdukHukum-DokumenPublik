<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Flat - Bootstrap 5 Template')</title>
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
              <h4 class="wow fadeInUp" data-wow-delay=".2s">You're Using</h4>
              <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Free Lite Version of Template</h2>
              <p class="mb-50 wow fadeInUp" data-wow-delay=".6s">Please, purchase full version of the template to get
                all sections, features and permission to remove footer credit</p>
              <div class="buttons">
                <a href="https://rebrand.ly/flat-ud/" rel="nofollow" target="blank"
                  class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".7s">Purchase Now</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-image">
              <img src="assets/img/hero/hero-2/hero-img.svg" alt="" class="wow fadeInRight" data-wow-delay=".2s">
              <img src="assets/img/hero/hero-2/paattern.svg" alt="" class="shape shape-1">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ========================= hero-2 end ========================= -->
    <!-- ========================= feature style-2 start ========================= -->
    <section id="services" class="feature-section feature-style-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-xl-7 col-lg-10 col-md-9">
                <div class="section-title mb-60">
                  <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">The future of designing starts here</h3>
                  <p class="wow fadeInUp" data-wow-delay=".4s">Stop wasting time and money designing and managing a
                    website that doesn’t get results. Happiness guaranteed!</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                  <div class="icon">
                    <i class="lni lni-vector"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Graphics Design</h5>
                    <p>Short description for the ones who look for something new.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                  <div class="icon">
                    <i class="lni lni-layers"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">UI/UX Design</h5>
                    <p>Short description for the ones who look for something new.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                  <div class="icon">
                    <i class="lni lni-layout"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Web Design</h5>
                    <p>Short description for the ones who look for something new.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="single-feature wow fadeInUp" data-wow-delay=".8s">
                  <div class="icon">
                    <i class="lni lni-display"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Web Development</h5>
                    <p>Short description for the ones who look for something new.</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="feature-img wow fadeInLeft" data-wow-delay=".2s">
        <img src="assets/img/feature/feature-2-1.svg" alt="">
      </div>
    </section>
    <!-- ========================= feature style-2 end ========================= -->

    <!-- ========================= about style-3 start ========================= -->
    <section id="about" class="about-section about-style-3">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="about-image wow fadeInLeft" data-wow-delay=".2s">
              <img src="assets/img/about/about-3/about-img.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-content-wrapper">
              <div class="section-title mb-40">
                <h3 class="mb-25 wow fadeInUp" data-wow-delay=".2s">The future of designing starts here</h3>
                <p class="wow fadeInUp" data-wow-delay=".4s">Stop wasting time and money designing and managing a
                  website that doesn’t get results. Happiness guaranteed, Stop wasting time and money designing and
                  managing a website that doesn’t get results. Happiness guaranteed,</p>
              </div>
              <div class="counter-up-wrapper mb-40 wow fadeInUp" data-wow-delay=".6s">
                <div class="single-counter">
                  <h4 class="countup" id="secondo1" cup-end="123" cup-append="M">123 M</h4>
                  <h6>Happy Client</h6>
                </div>
                <div class="single-counter">
                  <h4 class="countup" id="secondo2" cup-end="1434" cup-append="K">1434 K</h4>
                  <h6>Project Done</h6>
                </div>
                <div class="single-counter">
                  <h4 class="countup" id="secondo3" cup-end="134" cup-append="K">134 K</h4>
                  <h6>Award Win</h6>
                </div>
              </div>
              <a href="#0" class="button button-lg radius-3 wow fadeInUp" data-wow-delay=".7s">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= about style-3 end ========================= -->

    		<!-- ========================= pricing style-1 start ========================= -->
		<section id="pricing" class="pricing-section pricing-style-1 bg-white">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
            <div class="section-title text-center mb-60">
              <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Pricing Plan</h3>
              <p class="wow fadeInUp" data-wow-delay=".4s">Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed!</p>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-pricing wow fadeInUp" data-wow-delay=".2s">
              <div class="image">
                <img src="assets/img/pricing/pricing-1/pricing-1.svg" alt="">
              </div>
              <h6>Basic Design</h6>
              <h4>Web Design</h4>
              <h3>$ 29.00</h3>
              <ul>
                <li> <i class="lni lni-checkmark-circle"></i> Carefully crafted components</li>
                <li> <i class="lni lni-checkmark-circle"></i> Amazing page examples</li>
                <li> <i class="lni lni-checkmark-circle"></i> Super friendly support team</li>
                <li> <i class="lni lni-checkmark-circle"></i> Awesome Support</li>
              </ul>
              <a href="#0" class="button radius-30">Get Started</a>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-pricing active wow fadeInUp" data-wow-delay=".4s">
              <span class="button button-sm radius-30 popular-badge">Popular</span>
              <div class="image">
                <img src="assets/img/pricing/pricing-1/pricing-2.svg" alt="">
              </div>
              <h6>Standard Design</h6>
              <h4>Web Development</h4>
              <h3>$ 89.00</h3>
              <ul>
                <li> <i class="lni lni-checkmark-circle"></i> Carefully crafted components</li>
                <li> <i class="lni lni-checkmark-circle"></i> Amazing page examples</li>
                <li> <i class="lni lni-checkmark-circle"></i> Super friendly support team</li>
                <li> <i class="lni lni-checkmark-circle"></i> Awesome Support</li>
              </ul>
              <a href="#0" class="button radius-30">Get Started</a>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-pricing wow fadeInUp" data-wow-delay=".6s">
              <div class="image">
                <img src="assets/img/pricing/pricing-1/pricing-3.svg" alt="">
              </div>
              <h6>Pro Design</h6>
              <h4>Design & Develop</h4>
              <h3>$ 199.00</h3>
              <ul>
                <li> <i class="lni lni-checkmark-circle"></i> Carefully crafted components</li>
                <li> <i class="lni lni-checkmark-circle"></i> Amazing page examples</li>
                <li> <i class="lni lni-checkmark-circle"></i> Super friendly support team</li>
                <li> <i class="lni lni-checkmark-circle"></i> Awesome Support</li>
              </ul>
              <a href="#0" class="button radius-30">Get Started</a>
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