<?php

get_header();
get_template_part( 'banners/allpage-banner' );
$learn_link = '/updates';
$hero_bg = get_stylesheet_directory_uri() . '/assets/images/Rectangle 15.png'; 
$signup_logo = get_stylesheet_directory_uri() . '/assets/images/contact-logo.png'; 
?>


<main id="main" class="site-main " role="main">
  <section class="visit-us-section container-fluid" aria-labelledby="visit-us-title">


    <div class="visit-us-grid">
      <div class="visit-left">
        <h2 id="visit-us-title" class="visit-title">Visit Us</h2>

        <div class="contact-cards">
          <div class="contact-card">
            <span class="icon" aria-hidden="true">
            
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.72 19.72 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.72 19.72 0 0 1 3.08 4.18 2 2 0 0 1 5 2h3a2 2 0 0 1 2 1.72c.06.86.25 1.7.54 2.5a2 2 0 0 1-.45 2.11L9.91 9.91a16 16 0 0 0 6 6l1.58-1.58a2 2 0 0 1 2.11-.45c.8.29 1.64.48 2.5.54A2 2 0 0 1 22 16.92z" fill="#15345a"/>
              </svg>
            </span>
            <a class="contact-text" href="tel:+263779227037">+263 779 227 037</a>
          </div>

    
          <div class="contact-card">
            <span class="icon" aria-hidden="true">
         
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.5 3.5A11 11 0 1 0 12 23a11 11 0 0 0 8.5-19.5zm-8.5 17.2c-1.75 0-3.48-.47-5-1.36l-3.29.87.88-3.2A9.23 9.23 0 0 1 4 12.5c0-4.97 4.03-9 9-9 2.4 0 4.65.93 6.36 2.63A8.96 8.96 0 0 1 12 20.7z" fill="#15345a"/>
                <path d="M17.2 14.7c-.3-.15-1.75-.86-2.02-.95-.27-.09-.47-.15-.67.15-.2.3-.77.95-.95 1.15-.17.2-.34.22-.63.07-.3-.15-1.27-.47-2.42-1.5-.9-.8-1.5-1.8-1.68-2.1-.18-.3-.02-.46.13-.62.13-.13.3-.34.45-.5.15-.15.2-.27.3-.45.1-.18.05-.34-.02-.5-.07-.16-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51-.17-.01-.37-.01-.57-.01-.2 0-.5.07-.77.35-.27.29-1.05 1.03-1.05 2.5 0 1.46 1.08 2.88 1.23 3.08.15.2 2.12 3.33 5.13 4.66 3.02 1.33 3.02.89 3.57.84.55-.05 1.78-.72 2.03-1.41.24-.69.24-1.28.17-1.4-.07-.12-.27-.2-.57-.35z" fill="#fff" opacity="0.9"/>
              </svg>
            </span>
            <a class="contact-text" href="https://wa.me/263779227037" target="_blank" rel="noopener noreferrer">+263 779 227 037</a>
          </div>

       
          <div class="contact-card">
            <span class="icon" aria-hidden="true">
           
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 4H4a2 2 0 0 0-2 2v0 12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z" fill="#15345a"/>
              </svg>
            </span>
            <a class="contact-text" href="mailto:enquiries@northgateestates.co.zw">enquiries@northgateestates.<br> co.zw</a>
          </div>

       
          <div class="contact-card">
            <span class="icon" aria-hidden="true">
           
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z" fill="#15345a"/>
              </svg>
            </span>
            <div class="contact-text">
              5 Campbell Rd Pomona, <br>  Borrowdale, Harare, Zimbabwe
            </div>
          </div>
        </div>


      </div>

    
      <div class="visit-right">
        <div class="map-wrap">

        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d30398.771413982882!2d31.068398531503487!3d-17.751873859611532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s5%20campbell%20rd%20pomona!5e0!3m2!1sen!2szw!4v1764765697933!5m2!1sen!2szw" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- SIGNUP HERO -->
<section class="signup-hero " role="region" aria-label="Stay updated signup" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>')">
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="container-fluid hero-inner">
    <div class="">
      <h1 class="hero-title">Do You Want To<br>Stay Updated?</h1>
      <p class="hero-desc">
        Northgate Estates is a visionary development designed to redefine urban living, leveraging
        next-gen architecture, innovative technology, and sustainable design.
      </p>
      <a class="btn-secondary" href="<?php echo esc_url( $learn_link ); ?>">
        VIEW MORE UPDATES
      </a>
    </div>
  </div>
</section>


<?php get_footer(); ?>
