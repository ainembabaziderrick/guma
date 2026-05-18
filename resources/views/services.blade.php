
@extends('frontend.layouts.app')

@section('home_content')

<main class="main">

    <!-- Services Hero Section -->
<section id="services-hero" class="hero section dark-background">

  <div class="container">
    <div class="row gy-4 align-items-center">

      <!-- TEXT -->
      <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up">
        
        <h1>Our Professional Services</h1>
        
        <p>
          At LogicTech Innovationz, we deliver reliable, innovative, and scalable 
          technology solutions tailored to your business needs. From web development 
          to security systems, we help you grow, automate, and stay secure.
        </p>

        <div class="d-flex">
          <a href="#services" class="btn-get-started">View Services</a>
          <a href="contact.html" class="btn-watch-video d-flex align-items-center ms-3">
            <i class="bi bi-headset"></i>
            <span>Talk to Us</span>
          </a>
        </div>

      </div>

      <!-- IMAGE -->
      <div class="col-lg-6 hero-img text-center" data-aos="zoom-in" data-aos-delay="200">
        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="Our Services">
      </div>

    </div>
  </div>

</section>

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="zoom-in">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 5,
                  "spaceBetween": 120
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/clients-1.webp" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-2.webp" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-3.webp" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-4.webp" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-5.webp" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-6.webp" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-7.webp" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-8.webp" class="img-fluid" alt=""></div>
          </div>
        </div>

      </div>

    </section><!-- /Clients Section -->


    <!-- Services Section -->
<section id="services" class="services section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Our Services</h2>
    <p>At Logic Tech Innovationz, we provide cutting-edge technology solutions designed to help businesses grow, improve efficiency, and stay ahead in the digital era.</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <!-- Web Development -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-code-slash icon"></i></div>
          <h4><a href="#" class="stretched-link">Web Development</a></h4>
          <p>We design and develop responsive, modern websites and web applications that enhance your online presence and user experience.</p>
        </div>
      </div><!-- End Service Item -->

      <!-- System Design -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-diagram-3 icon"></i></div>
          <h4><a href="#" class="stretched-link">System Design & Development</a></h4>
          <p>We build custom systems such as management systems, dashboards, and enterprise solutions tailored to your business needs.</p>
        </div>
      </div><!-- End Service Item -->

      <!-- CCTV Installation -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-camera-video icon"></i></div>
          <h4><a href="#" class="stretched-link">Camera Installation</a></h4>
          <p>We provide professional CCTV camera installation services to improve security and monitor your business or property effectively.</p>
        </div>
      </div><!-- End Service Item -->

      <!-- GPS Tracking -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-geo-alt icon"></i></div>
          <h4><a href="#" class="stretched-link">GPS Tracking</a></h4>
          <p>Track and manage your vehicles or assets in real-time with our reliable GPS tracking solutions for improved control and safety.</p>
        </div>
      </div><!-- End Service Item -->

      <!-- IT Support -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="500">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-tools icon"></i></div>
          <h4><a href="#" class="stretched-link">IT Support & Maintenance</a></h4>
          <p>We offer continuous technical support, system maintenance, and troubleshooting to ensure smooth business operations.</p>
        </div>
      </div><!-- End Service Item -->

      <!-- Digital Marketing -->
      <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="600">
        <div class="service-item position-relative">
          <div class="icon"><i class="bi bi-megaphone icon"></i></div>
          <h4><a href="#" class="stretched-link">Digital Marketing</a></h4>
          <p>Grow your brand online with our digital marketing services including social media management, SEO, and online advertising.</p>
        </div>
      </div><!-- End Service Item -->

      <!-- Computer Sales -->
<div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="700">
  <div class="service-item position-relative">
    <div class="icon"><i class="bi bi-laptop icon"></i></div>
    <h4><a href="#" class="stretched-link">Computer Sales</a></h4>
    <p>
      We supply high-quality laptops, desktops, accessories, and IT equipment 
      from trusted brands to meet your personal and business needs.
    </p>
  </div>
</div><!-- End Service Item -->

<!-- Network Engineering -->
<div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="800">
  <div class="service-item position-relative">
    <div class="icon"><i class="bi bi-hdd-network icon"></i></div>
    <h4><a href="#" class="stretched-link">Network Engineering</a></h4>
    <p>
      We design, install, and maintain secure and efficient network infrastructures 
      including LAN, WAN, Wi-Fi setups, and server configurations.
    </p>
  </div>
</div><!-- End Service Item -->

    </div>

  </div>

</section><!-- /Services Section -->

   <!-- Work Process Section -->
<section id="work-process" class="work-process section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Our Work Process</h2>
    <p>We follow a structured and professional approach to ensure every project is delivered efficiently, meets client expectations, and achieves the desired results.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-5">

      <!-- Step 1 -->
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="steps-item">
          <div class="steps-image">
            <img src="assets/img/steps/steps-1.webp" alt="Consultation" class="img-fluid" loading="lazy">
          </div>
          <div class="steps-content">
            <div class="steps-number">01</div>
            <h3>Consultation & Requirements</h3>
            <p>We begin by understanding your business needs, goals, and challenges to determine the best technology solution for you.</p>
            <div class="steps-features">
              <div class="feature-item">
                <i class="bi bi-check-circle"></i>
                <span>Client Meetings</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle"></i>
                <span>Requirement Gathering</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle"></i>
                <span>Project Scope Definition</span>
              </div>
            </div>
          </div>
        </div><!-- End Steps Item -->
      </div>

      <!-- Step 2 -->
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="steps-item">
          <div class="steps-image">
            <img src="assets/img/steps/steps-2.webp" alt="Planning" class="img-fluid" loading="lazy">
          </div>
          <div class="steps-content">
            <div class="steps-number">02</div>
            <h3>Planning & Design</h3>
            <p>We design system architecture, UI/UX layouts, and technical plans to ensure a smooth and scalable solution.</p>
            <div class="steps-features">
              <div class="feature-item">
                <i class="bi bi-check-circle"></i>
                <span>System Architecture</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle"></i>
                <span>UI/UX Design</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle"></i>
                <span>Technical Planning</span>
              </div>
            </div>
          </div>
        </div><!-- End Steps Item -->
      </div>

      <!-- Step 3 -->
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
        <div class="steps-item">
          <div class="steps-image">
            <img src="assets/img/steps/steps-3.webp" alt="Implementation" class="img-fluid" loading="lazy">
          </div>
          <div class="steps-content">
            <div class="steps-number">03</div>
            <h3>Implementation & Deployment</h3>
            <p>We develop, install, test, and deploy your solution—ensuring everything works perfectly before going live.</p>
            <div class="steps-features">
              <div class="feature-item">
                <i class="bi bi-check-circle"></i>
                <span>Development & Installation</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle"></i>
                <span>Testing & Quality Assurance</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle"></i>
                <span>Deployment & Go Live</span>
              </div>
            </div>
          </div>
        </div><!-- End Steps Item -->
      </div>

    </div>

  </div>

</section><!-- /Work Process Section -->

    <!-- Call To Action Section -->
<section id="call-to-action" class="call-to-action section dark-background">

  <img src="assets/img/bg/bg-8.webp" alt="Logic Tech Innovationz CTA Background">

  <div class="container">

    <div class="row" data-aos="zoom-in" data-aos-delay="100">
      
      <div class="col-xl-9 text-center text-xl-start">
        <h3>Ready to Transform Your Business with Technology?</h3>
        <p>
          At Logic Tech Innovationz, we help businesses grow through professional web development, custom systems, CCTV installation, GPS tracking, IT support, and digital marketing. 
          Get in touch with us today and let’s turn your idea into a powerful digital solution.
        </p>
      </div>

      <div class="col-xl-3 cta-btn-container text-center">
        <a class="cta-btn align-middle" href="#contact">Get Started</a>
      </div>

    </div>

  </div>

</section><!-- /Call To Action Section -->    
 
    <!-- Pricing Section -->
<section id="pricing" class="pricing section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Our Pricing</h2>
    <p>We offer flexible and affordable pricing packages tailored to meet the needs of startups, small businesses, and large enterprises.</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <!-- Starter Package -->
      <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
        <div class="pricing-item">
          <h3>Starter Package</h3>
          <h4><sup>UGX</sup>530,000+</h4>
          <ul>
            <li><i class="bi bi-check"></i> <span>Basic Business Website</span></li>
            <li><i class="bi bi-check"></i> <span>Responsive Design</span></li>
            <li><i class="bi bi-check"></i> <span>Contact Form Integration</span></li>
            <li><i class="bi bi-check"></i> <span>Basic SEO Setup</span></li>
            <li class="na"><i class="bi bi-x"></i> <span>Advanced System Features</span></li>
          </ul>
          <a href="#contact" class="buy-btn">Get Started</a>
        </div>
      </div><!-- End Pricing Item -->

      <!-- Business Package -->
      <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
        <div class="pricing-item featured">
          <h3>Business Package</h3>
          <h4><sup>UGX</sup>1,700,000+</h4>
          <ul>
            <li><i class="bi bi-check"></i> <span>Custom Website / Web Application</span></li>
            <li><i class="bi bi-check"></i> <span>Admin Dashboard</span></li>
            <li><i class="bi bi-check"></i> <span>Database Integration</span></li>
            <li><i class="bi bi-check"></i> <span>API Integration</span></li>
            <li><i class="bi bi-check"></i> <span>Basic Support & Maintenance</span></li>
          </ul>
          <a href="#contact" class="buy-btn">Get Started</a>
        </div>
      </div><!-- End Pricing Item -->

      <!-- Advanced Solutions Package -->
      <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
        <div class="pricing-item">
          <h3>Advanced Solutions</h3>
          <h4><sup>UGX</sup>2,600,000+</h4>
          <ul>
            <li><i class="bi bi-check"></i> <span>Custom Enterprise Systems</span></li>
            <li><i class="bi bi-check"></i> <span>CCTV Installation Setup</span></li>
            <li><i class="bi bi-check"></i> <span>GPS Tracking Integration</span></li>
            <li><i class="bi bi-check"></i> <span>Advanced Security Features</span></li>
            <li><i class="bi bi-check"></i> <span>Priority IT Support & Maintenance</span></li>
          </ul>
          <a href="#contact" class="buy-btn">Get Started</a>
        </div>
      </div><!-- End Pricing Item -->

    </div>

  </div>

</section><!-- /Pricing Section -->  

    <!-- FAQ Section -->
<section id="faq-2" class="faq-2 section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Frequently Asked Questions</h2>
    <p>Find answers to common questions about Logic Tech Innovationz, our services, development process, and support.</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-lg-10">

        <div class="faq-container">

          <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
            <i class="faq-icon bi bi-question-circle"></i>
            <h3>What services does Logic Tech Innovationz offer?</h3>
            <div class="faq-content">
              <p>We offer web development, mobile app development, software solutions, system integration, IT consulting, and custom enterprise applications tailored to your business needs.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
            <i class="faq-icon bi bi-question-circle"></i>
            <h3>Do you build custom software solutions?</h3>
            <div class="faq-content">
              <p>Yes. We specialize in building custom software solutions designed specifically for your business processes, ensuring scalability, security, and performance.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
            <i class="faq-icon bi bi-question-circle"></i>
            <h3>How long does it take to complete a project?</h3>
            <div class="faq-content">
              <p>Project timelines vary depending on complexity. Small projects may take a few weeks, while larger enterprise systems can take several months. We provide timelines after requirement analysis.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
            <i class="faq-icon bi bi-question-circle"></i>
            <h3>Do you provide support and maintenance after delivery?</h3>
            <div class="faq-content">
              <p>Yes. We offer ongoing support, maintenance, updates, and bug fixes to ensure your system continues to run smoothly after deployment.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
            <i class="faq-icon bi bi-question-circle"></i>
            <h3>Can you integrate systems with existing platforms?</h3>
            <div class="faq-content">
              <p>Absolutely. We provide API development and third-party integrations to ensure your systems communicate effectively with other platforms and services.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>

        </div>

      </div>

    </div>

  </div>

</section><!-- /FAQ Section -->

    <!-- Subscribe Section -->
<section id="subscribe" class="subscribe section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4 justify-content-between align-items-center">

      <div class="col-lg-6">
        <div class="cta-content" data-aos="fade-up" data-aos-delay="200">
          <h2>Stay Updated with Logic Tech Innovationz</h2>
          <p>
            Subscribe to our newsletter to receive the latest updates on software solutions, technology trends, product releases, and industry insights from Logic Tech Innovationz.
          </p>

          <form action="forms/newsletter.php" method="post" class="php-email-form cta-form" data-aos="fade-up" data-aos-delay="300">
            <div class="input-group mb-3">
              <input type="email" name="email" class="form-control" placeholder="Enter your email address..." aria-label="Email address" required>
              <button class="btn btn-primary" type="submit" id="button-subscribe">Subscribe</button>
            </div>

            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Thank you for subscribing! You'll now receive updates from Logic Tech Innovationz.</div>
          </form>

        </div>
      </div>

      <div class="col-lg-4">
        <div class="cta-image" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/cta/camera.jpeg" alt="Newsletter subscription" class="img-fluid">
        </div>
      </div>

    </div>
  </div>

</section><!-- /Subscribe Section -->
  
  </main> 
    
@endsection