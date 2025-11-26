<?php
/**
 * front-page.php
 * Static front page template.
 */

get_header();
$right_image = get_stylesheet_directory_uri() . '/assets/images/image 8.png'; 
$logo = get_stylesheet_directory_uri() . '/assets/images/logo-small.png';
$signup_logo = get_stylesheet_directory_uri() . '/assets/images/contact-logo.png'; 
$learn_link = '/about-us';
$invest_link = '#invest';
?>

<div class="container-fluid mt-2">
  <?php the_content();?>
</div>




<!-- SIGNUP HERO -->
<section class="signup-hero  front-page-margin" role="region" aria-label="Stay updated signup" style="background-image: url('<?php echo esc_url( $right_image ); ?>')">
  <div class="hero-overlay" aria-hidden="true"></div>

  <div class=" hero-inner">
    <div>
      <h1 class="hero-title">Do You Want To<br>Stay Updated?</h1>
      <p class="hero-desc">
        Northgate Estates is a visionary development designed to redefine urban living, leveraging
        next-gen architecture, innovative technology, and sustainable design.
      </p>
    </div>

    <aside class="hero-signup" aria-labelledby="signup-title">
      <div class="signup-card">
        <div class="signup-top">
          <img src="<?php echo esc_url( $signup_logo ); ?>" alt="Northgate Estates" class="signup-logo">
          <p class="section-lead">Our Nicklaus-design championship golf course offers a fantastic experience for golfers of all levels.</p>
        </div>

        <form id="signup-form" class="signup-form" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
        <input type="hidden" name="action" value="newsletter_signup">

       <label for="name" class="sr-only">Name</label>
       <input id="name" name="name" type="text" placeholder="Name Surname" required>

       <label for="email" class="sr-only">Email</label>
       <input id="email" name="email" type="email" placeholder="Email" required>

       <label for="message" class="sr-only">Message</label>
       <textarea id="message" name="message" placeholder="Message (optional)" rows="4"></textarea>

       <button type="submit" class="btn-secondary">SEND</button>
       </form>

      </div>
    </aside>
  </div>
</section>

<?php get_footer(); ?>