@extends('layouts.guest.app')

@section('title', 'Dashboard')

@section('content')
    <!-- ========================= hero-section-wrapper-2 start ========================= -->
    <section id="home" class="hero-section-wrapper-2">

      {{-- Header --}}
      @include('layouts.guest.header')

      <!-- ========================= hero-2 start ========================= -->
      <div class="hero-section hero-style-2">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-6">
              <div class="hero-content-wrapper">
                <h4 class="wow fadeInUp" data-wow-delay=".2s">You're Using</h4>
                <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Free Lite Version of Template</h2>
                <p class="mb-50 wow fadeInUp" data-wow-delay=".6s">Please, purchase full version of the template to get all sections, features and permission to remove footer credit</p>
                <div class="buttons">
                  <a href="https://rebrand.ly/flat-ud/" rel="nofollow" target="blank" class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".7s">Purchase Now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="hero-image">
                <img src="{{ asset('guest/img/hero/hero-2/hero-img.svg') }}" alt="" class="wow fadeInRight" data-wow-delay=".2s">
                <img src="{{ asset('guest/img/hero/hero-2/paattern.svg') }}" alt="" class="shape shape-1">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ========================= hero-2 end ========================= -->

    </section>
    <!-- ========================= hero-section-wrapper-2 end ========================= -->

    <!-- ========================= feature style-2 start ========================= -->
    <section id="warga" class="feature-section feature-style-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-xl-7 col-lg-10 col-md-9">
                <div class="section-title mb-60">
                  <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Data Warga</h3>
                  <p class="wow fadeInUp" data-wow-delay=".4s">Kelola data warga dengan mudah. Tambah, edit, dan hapus data warga.</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                  <div class="icon">
                    <i class="lni lni-users"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Kelola Data Warga</h5>
                    <p>Lakukan operasi CRUD (Create, Read, Update, Delete) pada data warga dengan mudah.</p>
                    <div class="buttons mt-30">
                      <a href="{{ route('warga.index') }}" class="button button-lg radius-10">Kelola Warga <i class="lni lni-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="feature-img wow fadeInLeft" data-wow-delay=".2s">
        <img src="{{ asset('guest/img/feature/feature-2-1.svg') }}" alt="">
      </div>
    </section>
    <!-- ========================= feature style-2 end ========================= -->

    <!-- ========================= about style-3 start ========================= -->
    <section id="jenis-dokumen" class="about-section about-style-3">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="about-image wow fadeInLeft" data-wow-delay=".2s">
              <img src="{{ asset('guest/img/about/about-3/about-img.jpg') }}" alt="">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-content-wrapper">
              <div class="section-title mb-40">
                <h3 class="mb-25 wow fadeInUp" data-wow-delay=".2s">Jenis Dokumen</h3>
                <p class="wow fadeInUp" data-wow-delay=".4s">Kelola jenis dokumen dengan mudah. Tambah, edit, dan hapus jenis dokumen yang tersedia.</p>
              </div>
              <div class="buttons mb-40 wow fadeInUp" data-wow-delay=".6s">
                <a href="{{ route('jenis-dokumen.index') }}" class="button button-lg radius-3">Kelola Jenis Dokumen <i class="lni lni-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= about style-3 end ========================= -->

    <div class="container pt-60 pb-60">
      <h4 class="wow fadeInUp" data-wow-delay=".2s">You're Using</h4>
      <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Free Lite Version of Template</h2>
      <p class="mb-50 wow fadeInUp" data-wow-delay=".6s">Please, purchase full version of the template to get all sections, features and permission to remove footer credit</p>
      <div class="buttons">
        <a href="https://rebrand.ly/flat-ud/" rel="nofollow" target="blank" class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".7s">Purchase Now</a>
      </div>
    </div>

    <!-- ========================= pricing style-1 start ========================= -->
    <section id="pricing" class="pricing-section pricing-style-1 bg-white">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
            <div class="section-title text-center mb-60">
              <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Pricing Plan</h3>
              <p class="wow fadeInUp" data-wow-delay=".4s">Stop wasting time and money designing and managing a website that doesn't get results. Happiness guaranteed!</p>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-pricing wow fadeInUp" data-wow-delay=".2s">
              <div class="image">
                <img src="{{ asset('guest/img/pricing/pricing-1/pricing-1.svg') }}" alt="">
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
                <img src="{{ asset('guest/img/pricing/pricing-1/pricing-2.svg') }}" alt="">
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
                <img src="{{ asset('guest/img/pricing/pricing-1/pricing-3.svg') }}" alt="">
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

    <!-- ========================= team style-1 start ========================= -->
    <section id="team" class="team-section team-style-1">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
            <div class="section-title text-center mb-60">
              <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Our Team</h3>
              <p class="wow fadeInUp" data-wow-delay=".4s">Stop wasting time and money designing and managing a website that doesn't get results. Happiness guaranteed!</p>
            </div>
          </div>
        </div>
        
        <div class="row justify-content-center">
          <div class="col-xl-3 col-md-6 col-sm-10">
            <div class="single-team wow fadeInUp" data-wow-delay=".2s">
              <div class="image">
                <img src="{{ asset('guest/img/team/team-1/team-1.png') }}" alt="">
              </div>
              <div class="info">
                <h6>John Doe</h6>
                <p>Product Designer</p>
                <ul class="socials">
                  <li>
                    <a href="#0"> <i class="lni lni-facebook-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-twitter-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-instagram-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-linkedin-original"></i> </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-10">
            <div class="single-team wow fadeInUp" data-wow-delay=".4s">
              <div class="image">
                <img src="{{ asset('guest/img/team/team-1/team-2.png') }}" alt="">
              </div>
              <div class="info">
                <h6>David Endow</h6>
                <p>Creative Designer</p>
                <ul class="socials">
                  <li>
                    <a href="#0"> <i class="lni lni-facebook-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-twitter-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-instagram-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-linkedin-original"></i> </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-10">
            <div class="single-team wow fadeInUp" data-wow-delay=".6s">
              <div class="image">
                <img src="{{ asset('guest/img/team/team-1/team-3.png') }}" alt="">
              </div>
              <div class="info">
                <h6>Jonathon Smith</h6>
                <p>Brand Designer</p>
                <ul class="socials">
                  <li>
                    <a href="#0"> <i class="lni lni-facebook-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-twitter-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-instagram-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-linkedin-original"></i> </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-10">
            <div class="single-team wow fadeInUp" data-wow-delay=".8s">
              <div class="image">
                <img src="{{ asset('guest/img/team/team-1/team-4.png') }}" alt="">
              </div>
              <div class="info">
                <h6>Gray Simon</h6>
                <p>Frontend Developer</p>
                <ul class="socials">
                  <li>
                    <a href="#0"> <i class="lni lni-facebook-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-twitter-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-instagram-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-linkedin-original"></i> </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- ========================= team style-1 end ========================= -->

    <div class="container pt-60 pb-60">
      <h4 class="wow fadeInUp" data-wow-delay=".2s">You're Using</h4>
      <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Free Lite Version of Template</h2>
      <p class="mb-50 wow fadeInUp" data-wow-delay=".6s">Please, purchase full version of the template to get all sections, features and permission to remove footer credit</p>
      <div class="buttons">
        <a href="https://rebrand.ly/flat-ud/" rel="nofollow" target="blank" class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".7s">Purchase Now</a>
      </div>
    </div>

    <!-- ========================= contact style-6 start ========================= -->
    <section id="contact" class="contact-section contact-style-6">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="contact-form-wrapper">
              <form action="assets/php/contact.php" method="POST">
                <div class="row">
                  <div class="col-md-6">
                    <div class="single-input">
                      <label for="name">Name</label>
                      <input type="text" id="name" name="name" class="form-input" placeholder="Name">
                      <i class="lni lni-user"></i>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="single-input">
                      <label for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-input" placeholder="Email">
                      <i class="lni lni-envelope"></i>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="single-input">
                      <label for="number">Number</label>
                      <input type="text" id="number" name="number" class="form-input" placeholder="Number">
                      <i class="lni lni-phone"></i>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="single-input">
                      <label for="subject">Subject</label>
                      <input type="text" id="subject" name="subject" class="form-input" placeholder="Subject">
                      <i class="lni lni-text-format"></i>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="single-input">
                      <label for="message">Message</label>
                      <textarea name="message" id="message" class="form-input" placeholder="Message" rows="6"></textarea>
                      <i class="lni lni-comments-alt"></i>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-button">
                      <button type="submit" class="button radius-10">Submit <i class="lni lni-telegram-original"></i> </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

          </div>

          <div class="col-lg-5 order-first order-lg-last">
            <div class="left-wrapper">
              <div class="section-title mb-40">
                <h3 class="mb-15">Get in touch</h3>
                <p>Stop wasting time and money designing and managing a website that doesn't get results. Happiness guaranteed!</p>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-6">
                  <div class="single-item">
                    <div class="icon">
                      <i class="lni lni-phone"></i>
                    </div>
                    <div class="text">
                      <p>0045939863784</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-6">
                  <div class="single-item">
                    <div class="icon">
                      <i class="lni lni-envelope"></i>
                    </div>
                    <div class="text">
                      <p>yourmail@gmail.com</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-6">
                  <div class="single-item">
                    <div class="icon">
                      <i class="lni lni-map-marker"></i>
                    </div>
                    <div class="text">
                      <p>John's House, 13/5 Road, Sidny United State Of America</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= contact style-6 end ========================= -->

    <!-- ========================= clients-logo start ========================= -->
    <section class="clients-logo-section pt-100 pb-100">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="client-logo wow fadeInUp" data-wow-delay=".2s">
              <img src="{{ asset('guest/img/clients/brands.svg') }}" alt="" class="w-100">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================= clients-logo end ========================= -->
@endsection
