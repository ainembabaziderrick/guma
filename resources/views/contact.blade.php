@extends('frontend.layouts.app')

@section('home_content')


 <main class="main">

   <!-- Contact Hero Section -->
<section id="hero-contact" class="hero section dark-background">

  <div class="container">
    <div class="row gy-4 align-items-center">

      <!-- TEXT -->
      <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up">
        
        <h1>Get In Touch With Us</h1>

        <p>
          Have a project in mind or need IT support? LogicTech Innovationz is here to help. 
          Reach out to us for web development, system solutions, CCTV installation, GPS tracking, 
          and digital marketing services.
        </p>

        @include('message')

        <div class="d-flex gap-3">
          <a href="#contact" class="btn-get-started">Send Message</a>

          <a href="tel:+256703996251" class="btn-watch-video d-flex align-items-center">
            <i class="bi bi-telephone"></i>
            <span>Call Now</span>
          </a>
        </div>

      </div>

      <!-- IMAGE -->
      <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="Contact LogicTech Innovationz">
      </div>

    </div>
  </div>

</section>
<!-- /Contact Hero Section -->

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
    