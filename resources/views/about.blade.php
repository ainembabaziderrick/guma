@extends('frontend.layouts.app')

@section('home_content')

<main class="main">

    <!-- Hero Section (About Page) -->
<section id="hero" class="hero section dark-background">

  <div class="container">
    <div class="row gy-4">

      <!-- TEXT CONTENT -->
      <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="zoom-out">
        
        <h1>About LogicTech Innovationz</h1>
        
        <p>
          We are a dynamic technology company based in Kanyanya, Kampala, dedicated to delivering 
          innovative IT solutions that empower businesses to grow, stay secure, and succeed in the digital world.
        </p>

        <div class="d-flex">
          <a href="#about" class="btn-get-started">Learn More</a>

          <a href="contact.html" class="btn-watch-video d-flex align-items-center">
            <i class="bi bi-telephone"></i>
            <span>Contact Us</span>
          </a>
        </div>

      </div>

      <!-- IMAGE -->
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="About LogicTech Innovationz">
      </div>

    </div>
  </div>

</section>
<!-- /Hero Section -->

    
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
 

</main>    
    
          
           
@endsection