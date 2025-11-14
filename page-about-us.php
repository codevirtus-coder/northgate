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



$what_right_image = get_stylesheet_directory_uri() . '/assets/images/image 11.png'; 
$features = [
  [
    'icon'  => get_stylesheet_directory_uri() . '/assets/images/icons/Mask group.png',
    'title' => 'Properties',
    'text'  => 'Whether you’re seeking the convenience of an apartment, a lock-up and go cluster, a freehold stand to design your dream home or a comfortable retirement home at our Senior Village, there is a home for everyone, at every life stage, in Steyn City.'
  ],
  [
    'icon'  => get_stylesheet_directory_uri() . '/assets/images/icons/Mask group 2.png',
    'title' => 'Golf',
    'text'  => 'Our Nicklaus-design championship golf course offers a fantastic experience for golfers of all levels. It’s not just the stunning views that make it remarkable; from our state-of-the-art golf academy to our gym, luxe changing rooms, and well stocked Pro Shop.'
  ],
  [
    'icon'  => get_stylesheet_directory_uri() . '/assets/images/icons/Mask group 3.png',
    'title' => 'School',
    'text'  => 'Whether you’re seeking the convenience of an apartment, a lock-up and go cluster, a freehold stand to design your dream home or a comfortable retirement home at our Senior Village, there is a home for everyone, at every life stage, in Steyn City.'
  ],
  [
    'icon'  => get_stylesheet_directory_uri() . '/assets/images/icons/Mask group 4.png',
    'title' => 'Luxury Estate Gate',
    'text'  => 'Whether you’re seeking the convenience of an apartment, a lock-up and go cluster, a freehold stand to design your dream home or a comfortable retirement home at our Senior Village, there is a home for everyone, at every life stage, in Steyn City.'
  ],
];
?>


<section class="split-hero" aria-label="Where life finds its space">
  <div class="split-hero-inner">
    <div class="hero-left" style="--left-bg: url('<?php echo esc_url( $right_image ); ?>')">
    <div class="container-fluid">
      <h1 class="hero-headline">WHERE LIFE<br>FINDS ITS<br>SPACE</h1>
      <p class="section-lead">
        Northgate Estates is a visionary development designed to redefine urban living, leveraging
        next-gen architecture, innovative technology, and sustainable design. Situated on the outskirts
        of Harare, approximately 17km north of the city, the Estates will cater to the discerning needs
        of individuals seeking a harmonious fusion of contemporary aesthetics and innovation.
      </p>
      <div class="hero-stats">
        <div class="stat">
          <div class="stat-number">607+</div>
          <div class="section-lead">Northgate, Zimbabwe’s most secure luxury lifestyle.</div>
        </div>
        <div class="stat">
          <div class="stat-number">77+</div>
          <div class="section-lead">Northgate, Zimbabwe’s most secure luxury lifestyle.</div>
        </div>
      </div>
     </div>
    </div>

    <!-- RIGHT: image and two CTA buttons top-right -->
    <div class="hero-right">
      <div class="cta-group" role="group" aria-label="primary actions">
        <div class="cta-primary">
            <a class="cta-primary" href="<?php echo esc_url( $learn_link ); ?>">LEARN MORE</a>
        </div>
        
        <div class="cta-ghost" >
            <a class="btn-ghost" href="<?php echo esc_url( $invest_link ); ?>">INVEST TO LIVE HERE</a>
        </div>
      </div>

      <div class="hero-image-wrap" aria-hidden="false">
        <img class="hero-image" src="<?php echo esc_url( $right_image ); ?>" alt="Northgate exterior">
      </div>
    </div>

</section>


<!---->
 <section class="container-fluid">
   <div class="hero-two-col py-5">    
     <div class="hero-text">
        <h2 class="section-heading">WHERE YOU, <br>LIVE CAN CHANGE<br> YOUR LIFE</h2>
         <p class="section-lead">
            Northgate Estates is a visionary development designed to redefine urban living, leveraging next-gen architecture, innovative technology, and sustainable design. Situated on the outskirts of Harare, approximately 17 km north of the city, the Estates will cater to the discerning needs of individuals seeking a harmonious fusion of contemporary aesthetics and innovation.
         </p>

         <!-- Key Features -->
         <h3 class="section-lead">Key Features</h3>
        <ul class="section-lead">
         <li>Smart living spaces: Integration of innovative technology that ensures a high-quality life in an urban utopia.</li>
         <li>Green infrastructure: Emphasis on sustainability with eco-friendly design elements, energy-efficient systems, and green spaces that promote overall well-being.</li>
         <li>Luxurious amenities: An array of world-class facilities including modern mobility, pristine courtyards, centralized civic services, retail shopping, light industry, education, and places of worship.</li>
       </ul>

       <div class="d-flex flex-wrap gap-3">
         <a class="btn-secondary" href="<?php echo esc_url( home_url( '/residential' ) ); ?>">LEARN MORE</a>
   
      <div class="datvest-image">
         <?php
           $hero_img = get_template_directory_uri() . '/assets/images/icons/image 33.png';
          ?>
          <img src="<?php echo esc_url( $hero_img ); ?>" alt="Residential pool and courtyard">
       </div>
       </div>

        
      </div>

       <div class="hero-image">
         <?php
           $hero_img = get_template_directory_uri() . '/assets/images/Rectangle 17.png';
          ?>
          <img src="<?php echo esc_url( $hero_img ); ?>" alt="Residential pool and courtyard">
       </div>
    </div>
  </section>

<section class="bg-light-gray">
 <div class="container-fluid"> 
   <div class="house-plan-section container-fluid">
      <div class="lifestyle-header">
        <h2 class="section-heading"> See Our Upcoming<br>Projects & Stands</h2>
      </div>
     <div class="lifestyle-grid">
      <?php
      $homes_query = new WP_Query( array(
        'posts_per_page' => 4,
        'category_name'  => 'homes',
      ) );

      if ( $homes_query->have_posts() ) :
        while ( $homes_query->have_posts() ) : $homes_query->the_post();
          $img = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: get_template_directory_uri() . '/assets/images/cluster-placeholder.jpg';
          ?>
          <article class="home-card" style="background-image:url('<?php echo esc_url( $img ); ?>')">
            <a href="<?php the_permalink(); ?>" class="home-card-link">
              <div class="home-card-caption">
                <strong><?php the_title(); ?></strong>
                <span class="muted">Neat Homes to fit your family</span>
              </div>
            </a>
          </article>
          <?php
        endwhile;

        
        wp_reset_postdata();
      else:
        $fallback = array(
          'home-image-1.png',
          'home-image-2.png',
        );
        foreach ( $fallback as $i => $file ) {
          $img = get_template_directory_uri() . '/assets/images/' . $file;
          ?>
        
        <div >
          <article class="home-card" style="background-image:url('<?php echo esc_url( $img ); ?>')">    
          </article>
            <div class="house-plan-cards">
                <p class="section-lead-news-heading">Cluster Homes <?php echo $i + 1; ?></p>
                <p class="section-lead">Our Neat home type design offers a fantastic experience for home seekers of all levels.</p>
                <div>
               <div class="lifestyle-cta-wrap">
                 <a class="btn-secondary" href="<?php echo esc_url( home_url( '#' ) ); ?>">See House</a>
               </div>
                </div>
            </div> 
          </div>
          <?php
        }
      endif;
      ?>

  
    </div>
  </div>  
  </div>
  
    <div class="hero-two-col container-fluid">
      <!-- LEFT: features -->
      <div class="hero-text">
        <div class="d-flex align-items-center mb-4">
          <h2 class="section-heading">What's in It</h2>
          <div class="flex-grow-1 ms-3 title-divider"></div>
        </div>

        <div class="row gy-4">
          <?php foreach ( $features as $feat ) : ?>
            <div class="col-12 d-flex">
              <img src="<?php echo esc_url( $feat['icon'] ); ?>" alt="<?php echo esc_attr( $feat['title'] ); ?>" class="feature-icon me-3">
              <div>
                <h5 class="feature-title"><?php echo esc_html( $feat['title'] ); ?></h5>
                <p class="section-lead"><?php echo esc_html( $feat['text'] ); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- RIGHT: large image -->
    <div class="hero-image">
      <img
        src="<?php echo esc_url( $what_right_image ); ?>"
        alt="<?php esc_attr_e( 'Estate preview', 'your-textdomain' ); ?>"
      >
    </div>
  </div>
</section>
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