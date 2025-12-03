<?php
/**
 * front-page.php
 * Static front page template.
 */

get_header();
$right_image = get_stylesheet_directory_uri() . '/assets/images/image 8.png'; 
$logo = get_stylesheet_directory_uri() . '/assets/images/logo-small.png';
$signup_logo = get_stylesheet_directory_uri() . '/assets/images/contact-logo.png'; 
$learn_link = '/updates';
$invest_link = '#invest';
?>

<div class="container-fluid mt-2">
  <?php the_content();?>
</div>


<!-- SIGNUP HERO -->
<section class="signup-hero " role="region" aria-label="Stay updated signup" style="background-image: url('<?php echo esc_url( $right_image ); ?>')">
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