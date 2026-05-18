

@extends('frontend.layouts.app')

@section('home_content')

<main class="main">

    <!-- Hero Section (Team Page) -->
<section id="hero" class="hero section dark-background">

  <div class="container">
    <div class="row gy-4 align-items-center">

      <!-- TEXT CONTENT -->
      <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="zoom-out">
        
        <h1>Meet Our Expert Team</h1>
        
        <p>
          At LogicTech Innovationz, our success is driven by a team of passionate professionals 
          dedicated to delivering innovative technology solutions. From developers to technicians, 
          we work together to bring your ideas to life.
        </p>

        @include('message')

        <div class="d-flex">
          <a href="#team" class="btn-get-started">View Team</a>

          <a href="#contact" class="btn-watch-video d-flex align-items-center">
            <i class="bi bi-telephone"></i>
            <span>Work With Us</span>
          </a>
        </div>

      </div>

      <!-- IMAGE -->
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="Our Team">
      </div>

    </div>
  </div>

</section>
<!-- /Hero Section -->

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

    <!-- About Section -->
<section id="about" class="about section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>About Us</h2>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <!-- LEFT CONTENT -->
      <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
        <p>
          LogicTech Innovationz is a forward-thinking technology company dedicated to providing reliable and innovative IT solutions. 
          We help businesses improve efficiency, strengthen security, and enhance their online presence through modern digital tools.
        </p>

        <ul>
          <li><i class="bi bi-check2-circle"></i> <span>Professional Web Design & Development Services</span></li>
          <li><i class="bi bi-check2-circle"></i> <span>Custom System Development for Businesses</span></li>
          <li><i class="bi bi-check2-circle"></i> <span>CCTV & GPS Installation for Security and Tracking</span></li>
        </ul>
      </div>

      <!-- RIGHT CONTENT -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <p>
          At LogicTech Innovationz, we combine creativity, technology, and expertise to deliver solutions that meet the unique needs of our clients. 
          Whether you need a professional website, a custom system, or advanced security installations, our team is committed to delivering quality results.
        </p>

        <p>
          We pride ourselves on reliability, innovation, and customer satisfaction, making us a trusted partner for businesses looking to grow and succeed in the digital world.
        </p>

        <a href="#contact" class="read-more">
          <span>Get In Touch</span><i class="bi bi-arrow-right"></i>
        </a>
      </div>

    </div>

  </div>

</section>
<!-- /About Section -->

    <!-- Why Us Section -->
<section id="why-us" class="section why-us light-background">

  <div class="container-fluid">

    <div class="row gy-4">

      <!-- LEFT CONTENT -->
      <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">

        <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
          <h3>
            <span>Why Choose </span>
            <strong>LogicTech Innovationz?</strong>
          </h3>
          <p>
            We are committed to delivering reliable, innovative, and affordable technology solutions 
            that help businesses grow, stay secure, and operate efficiently in today’s digital world.
          </p>
        </div>

        <!-- FAQ / FEATURES -->
        <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

          <div class="faq-item faq-active">
            <h3><span>01</span> Professional & Reliable Services</h3>
            <div class="faq-content">
              <p>
                Our team delivers high-quality web design, system development, CCTV, and GPS installation services 
                with a strong focus on reliability and customer satisfaction.
              </p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>

          <div class="faq-item">
            <h3><span>02</span> Customized Solutions for Your Business</h3>
            <div class="faq-content">
              <p>
                We understand that every business is unique. That’s why we provide tailored solutions 
                designed to meet your specific needs and goals.
              </p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>

          <div class="faq-item">
            <h3><span>03</span> Affordable & Scalable Technology</h3>
            <div class="faq-content">
              <p>
                Our solutions are cost-effective and designed to grow with your business, ensuring 
                long-term value and performance.
              </p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>

          <div class="faq-item">
            <h3><span>04</span> Fast Support & Maintenance</h3>
            <div class="faq-content">
              <p>
                We provide ongoing support and quick response to ensure your systems and services 
                run smoothly at all times.
              </p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div>

        </div>

      </div>

      <!-- IMAGE -->
      <div class="col-lg-5 order-1 order-lg-2 why-us-img">
        <img src="assets/img/why-us.png" class="img-fluid" alt="LogicTech Innovationz Services" data-aos="zoom-in" data-aos-delay="100">
      </div>

    </div>

  </div>

</section>
<!-- /Why Us Section -->

    <!-- Skills Section -->
<section id="skills" class="skills section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row">

      <div class="col-lg-6 d-flex align-items-center">
        <img src="assets/img/illustration/illustration-10.webp" class="img-fluid" alt="Logic Tech Innovationz Skills">
      </div>

      <div class="col-lg-6 pt-4 pt-lg-0 content">

        <h3>Our Technical Expertise & Capabilities</h3>
        <p class="fst-italic">
          At Logic Tech Innovationz, we combine creativity and technical expertise to deliver scalable, secure, and modern digital solutions tailored to your business needs.
        </p>

        <div class="skills-content skills-animation">

          <div class="progress">
            <span class="skill"><span>Web Development (HTML, CSS, Bootstrap)</span> <i class="val">95%</i></span>
            <div class="progress-bar-wrap">
              <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div><!-- End Skills Item -->

          <div class="progress">
            <span class="skill"><span>JavaScript & React Development</span> <i class="val">90%</i></span>
            <div class="progress-bar-wrap">
              <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div><!-- End Skills Item -->

          <div class="progress">
            <span class="skill"><span>Backend Development (PHP & Laravel)</span> <i class="val">92%</i></span>
            <div class="progress-bar-wrap">
              <div class="progress-bar" role="progressbar" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div><!-- End Skills Item -->

          <div class="progress">
            <span class="skill"><span>Database Management (MySQL)</span> <i class="val">88%</i></span>
            <div class="progress-bar-wrap">
              <div class="progress-bar" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div><!-- End Skills Item -->

          <div class="progress">
            <span class="skill"><span>UI/UX Design & Prototyping</span> <i class="val">85%</i></span>
            <div class="progress-bar-wrap">
              <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div><!-- End Skills Item -->

        </div>

      </div>
    </div>

  </div>

</section><!-- /Skills Section -->

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

    
    <!-- Team Section -->
<section id="team" class="team section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Our Team</h2>
    <p>Our skilled and dedicated team works together to deliver innovative technology solutions that meet client needs and exceed expectations.</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <!-- CEO -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <div class="team-member d-flex align-items-start">
          <div class="pic">
            <img src="{{asset('assets/img/derrick.jpeg')}}" class="img-fluid" alt="CEO">
          </div>
          <div class="member-info">
            <h4>Ainembabazi Derrick</h4>
            <span>Chief Executive Officer</span>
            <p>Leads the company vision, strategy, and ensures delivery of high-quality technology solutions to clients.</p>
            <div class="social">
              <a href="#"><i class="bi bi-linkedin"></i></a>
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-twitter-x"></i></a>
            </div>
          </div>
        </div>
      </div><!-- End Team Member -->

      <!-- CTO / Developer -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <div class="team-member d-flex align-items-start">
          <div class="pic">
            <img src="assets/img/person/cto.webp" class="img-fluid" alt="CTO">
          </div>
          <div class="member-info">
            <h4>Kemigisha Prenela</h4>
            <span>Secretary </span>
            <p>
                Responsible for managing administrative tasks, coordinating communication within the team, 
                organizing meetings, maintaining records, and ensuring smooth day-to-day operations of the organization.
            </p>
            <div class="social">
              <a href="#"><i class="bi bi-linkedin"></i></a>
              <a href="#"><i class="bi bi-github"></i></a>
              <a href="#"><i class="bi bi-twitter-x"></i></a>
            </div>
          </div>
        </div>
      </div><!-- End Team Member -->

      <!-- Systems Engineer -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
        <div class="team-member d-flex align-items-start">
          <div class="pic">
            <img src="assets/img/person/dev.webp" class="img-fluid" alt="Developer">
          </div>
          <div class="member-info">
            <h4>Mugerwa Frank</h4>
            <span>Full Stack Developer</span>
            <p>Responsible for building web applications, management systems, and integrating backend and frontend functionalities.</p>
            <div class="social">
              <a href="#"><i class="bi bi-github"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
              <a href="#"><i class="bi bi-twitter-x"></i></a>
            </div>
          </div>
        </div>
      </div><!-- End Team Member -->

      <!-- IT Support / Field Technician -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
        <div class="team-member d-flex align-items-start">
          <div class="pic">
            <img src="assets/img/deus.jpeg" class="img-fluid" alt="Support">
          </div>
          <div class="member-info">
            <h4>Mweteise Deus</h4>
            <span>IT Support & Field Technician</span>
            <p>Handles CCTV installations, GPS tracking setup, troubleshooting, and provides on-site and remote technical support.</p>
            <div class="social">
              <a href="#"><i class="bi bi-whatsapp"></i></a>
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div><!-- End Team Member -->

    </div>

  </div>

</section><!-- /Team Section -->

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

    <!-- Testimonials Section -->
<section id="testimonials" class="testimonials section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Testimonials</h2>
    <p>What our clients say about Logic Tech Innovationz and our commitment to delivering reliable and innovative technology solutions.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

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
          }
        }
      </script>

      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/person/person-m-9.webp" class="testimonial-img" alt="">
            <h3>Michael K.</h3>
            <h4>Startup Founder</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>Logic Tech Innovationz helped us build a scalable web platform that perfectly fits our business needs. Their team is professional, responsive, and highly skilled.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/person/person-f-5.webp" class="testimonial-img" alt="">
            <h3>Sarah W.</h3>
            <h4>UI/UX Designer</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>The team delivered a clean and modern interface for our application. Their attention to detail and user experience is outstanding.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/person/person-f-12.webp" class="testimonial-img" alt="">
            <h3>Jennifer K.</h3>
            <h4>Business Owner</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>From consultation to deployment, Logic Tech Innovationz guided us through every step. Their solutions improved our operations significantly.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/person/person-m-12.webp" class="testimonial-img" alt="">
            <h3>David M.</h3>
            <h4>Software Developer</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>Working with Logic Tech Innovationz was seamless. Their APIs and system architecture are well designed and easy to integrate.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/person/person-m-13.webp" class="testimonial-img" alt="">
            <h3>Brian T.</h3>
            <h4>Entrepreneur</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>They transformed our idea into a fully functional product. Highly recommend Logic Tech Innovationz for any tech project.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div>

      </div>

      <div class="swiper-pagination"></div>
    </div>

  </div>

</section><!-- /Testimonials Section -->

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
  

    <!-- Contact Section -->
<section id="contact" class="contact section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Contact Us</h2>
    <p>Get in touch with Logic Tech Innovationz for software development, IT solutions, consultations, and technical support.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-5">

        <div class="info-wrap">

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h3>Address</h3>
              <p>Kanyanya, Kampala, Uganda</p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-telephone flex-shrink-0"></i>
            <div>
              <h3>Call Us</h3>
              <p>+256 703 996 251</p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h3>Email Us</h3>
              <p>info@logictechinnovationz.com</p>
            </div>
          </div><!-- End Info Item -->          

        </div>
      </div>

      <div class="col-lg-7">

        <form action="admin/messages/add" method="post"  data-aos="fade-up" data-aos-delay="200">
              @csrf
          <div class="row gy-4">

            <div class="col-md-6">
              <label for="name-field" class="pb-2">Your Name</label>
              <input type="text" name="name" id="name-field" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label for="email-field" class="pb-2">Your Email</label>
              <input type="email" name="email" id="email-field" class="form-control" required>
            </div>

            <div class="col-md-12">
              <label for="phone-field" class="pb-2">Phone</label>
              <input type="text" name="phone" id="phone-field" class="form-control" required>
            </div>

            <div class="col-md-12">
              <label for="subject-field" class="pb-2">Subject</label>
              <input type="text" name="subject" id="subject-field" class="form-control" required>
            </div>

            <div class="col-md-12">
              <label for="message-field" class="pb-2">Message</label>
              <textarea name="message" id="message-field" rows="10" class="form-control" required></textarea>
            </div>

            <div class="col-md-12 text-center">              

              <button type="submit" class="btn btn-primary">Send Message</button>
            </div>

          </div>

        </form>

      </div><!-- End Contact Form -->

    </div>

  </div>

</section><!-- /Contact Section -->

  </main>



   @endsection
    