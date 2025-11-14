<?php


get_header();
get_template_part( 'banners/banner-slider' );
$poster = get_template_directory_uri() . '/assets/images/Rectangle 36.png';
$mp4    = get_template_directory_uri() . '/assets/video/video.mp4';
$webm   = get_template_directory_uri() . '/assets/video/hero.webm';
?>

<section class="container-fluid mx-auto hero-two-col">
 
    <div class="hero-text">
      <h2 class="section-heading">CREATING SMART, <br> SUSTAINABLE <br> COMMUNITIES</h2>
      <p class="section-lead">
        Our aim is an aesthetic that is unique, neither a typical urban style nor an imitation,
        but rather a fresh contemporary look and feel, with a classical reference. We believe that
        this will enhance the prosperity and community of the area, creating not just a beautiful
        place to live in, but also a destination.
      </p>
      <a class="btn-secondary" href="<?php echo esc_url( home_url( '/about' ) ); ?>">LEARN MORE</a>
    </div>

    <div class="hero-image has-overlay">
      <?php $hero_img = get_template_directory_uri() . '/assets/images/Rectangle 17.png'; ?>
      <img src="<?php echo esc_url( $hero_img ); ?>" alt="Residential pool and courtyard">
        <span class="img-overlay" aria-hidden="true"></span>
    </div>

</section>

  <!-- LIFESTYLE / CLUSTER HOMES -->
<section  class="">
   <div class="lifestyle-section">
    <div class="container-fluid">
      <div class="lifestyle-header">
        <h2 class="section-heading">EXPERIENCE THE <br> ULTIMATE LUXURY LIFESTYLE</h2>
        <div class="lifestyle-intro">
          <p class="section-lead">Northgate Estates is a visionary development designed to redefine urban living, leveraging <span class="section-lead-gradient">next-gen architecture, innovative technology, and sustainable design.</span></p>
        </div>
      </div>

      <div class="lifestyle-grid">
        <?php
        $homes_query = new WP_Query( array(
          'posts_per_page' => 4,
          'category_name'  => 'homes',
          'post_status'    => 'publish',
          'ignore_sticky_posts' => true,
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
            'Group 11.png',
            'Group 10.png',
            'Group 9.png',
            'Group 8.png',
          );
         $fallback = array('Group 11.png','Group 10.png','Group 9.png','Group 8.png');
         $titles   = array('400 sqm Stands','500-600 sqm Stands','1000sqm Stands','Cluster Housing');

        foreach ( $fallback as $i => $file ) {
        $img   = get_template_directory_uri() . '/assets/images/' . $file;
        $title = $titles[$i] ?? 'Homes';
        ?>
      <article class="home-card" style="background-image:url('<?php echo esc_url( $img ); ?>')">
      <div class="home-card-caption">
      <p class="home-card-caption-text"><?php echo esc_html( $title ); ?></p>
      <p class="muted">Neat Homes to fit your family</p>
       </div>
       </article>
       <?php
          }
        endif;
        ?>
      </div>

      <div class="lifestyle-cta-wrap">
        <a class="btn-secondary" href="<?php echo esc_url( home_url( '/residential' ) ); ?>">LEARN MORE</a>
      </div>
    </div>
  </section>

  <?php
  $news_args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'category_name'       => 'news',   
    'posts_per_page'      => 4,
    'ignore_sticky_posts' => true,
  );
  $news = new WP_Query( $news_args );
  $has_news = ( ! empty( $news->found_posts ) && intval( $news->found_posts ) > 0 );
  ?>

  <section class="py-5 my-5">
    <div class="container-fluid ">
      <div class="news-header">
        <h2 class="section-heading">UPDATES &amp; NEWS</h2>

        <?php if ( $has_news ) : ?>
          <div class="news-nav">
            <button class="news-prev" aria-label="Previous">&lsaquo;</button>
            <button class="news-next" aria-label="Next">&rsaquo;</button>
          </div>
        <?php endif; ?>
      </div>

      <?php if ( $has_news ) : ?>
        <div class="news-carousel" id="newsCarousel">
          <?php
          while ( $news->have_posts() ) : $news->the_post();
            $img = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: get_template_directory_uri() . '/assets/images/default.png';
            $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 18, '...' );
            ?>
      <article class="news-card">
             <a href="<?php the_permalink(); ?>">
          <div class="news-thumb" style="background-image:url('<?php echo esc_url( $img ); ?>')"></div>
          <div class="news-body">
            
            <h3 class="section-lead-news-heading"><?php echo esc_html( get_the_title() ); ?></h3>

            <time class="news-date" datetime="<?php echo esc_attr( get_the_date('c') ); ?>">
              <?php echo esc_html( get_the_date() ); ?>
            </time>

            <!-- SHOW the excerpt (this was commented out) -->
            <p class="section-lead muted"><?php echo esc_html( $excerpt ); ?></p>

            <p class="btn-secondary">READ MORE</p>
          </div>
         </a>
      </article>

            <?php
          endwhile;
          wp_reset_postdata();
          ?>
        </div> 
      <?php endif; ?>
    </div>
  </section>


<section class="featured-tiles" aria-label="Featured categories">
  <div class="container-fluid-fluid"> 
        <div class="tiles-grid">
          <?php
          $tiles = array(
            array('img' => 'icon-4.png', 'label' => 'PLAY'),
            array('img' => 'icon-6.png', 'label' => 'SHOP'),
            array('img' => 'icon-5.png', 'label' => 'WORK'),
            array('img' => 'icon-4.png', 'label' => 'STAY'),
            array('img' => 'icon-5.png', 'label' => 'HEALTH'),
            array('img' => 'icon-6.png', 'label' => 'TRAVEL'),
            array('img' => 'icon-7.png', 'label' => 'TRAVEL'),
          );
          foreach ( $tiles as $t ) {
            $img_url = get_template_directory_uri() . '/assets/images/icons/' . $t['img'];
            ?>
            <div class="tile">
              <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $t['label'] ); ?>" class="tile-image" />
              <p class="tile-label"><?php echo esc_html( $t['label'] ); ?></p>
            </div>
            <?php
          }
          ?>
        </div>
  </div>
</section>


<section class="partners-section">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12 partners-left">
        <h3 class="partners-title">OUR PROUD<br><span>PARTNERS</span></h3>
        <!-- <div class="partners-line d-block mt-8" aria-hidden="true"></div> -->
         <?php $vector_img = get_template_directory_uri() . '/assets/images/icons/Vector 4.png'; ?>
         <img src="<?php echo esc_url( $vector_img ); ?>" alt="partners line decorative" class="partners-decorative" />
      </div>
      <div class="col-lg-6 col-md-12 partners-right">
        <div class="partners-grid">
          <?php
          $partners = array(
            'partner-1.png',
            'partner-2.png',
            'partner-3.png',
            'partner-4.png',
            'partner-5.png',
          );
          foreach ( $partners as $logo ) {
            $logo_url = get_template_directory_uri() . '/assets/images/partners/' . $logo;
            ?>
            <div class="partner-item">
              <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( pathinfo( $logo, PATHINFO_FILENAME ) ); ?> logo" />
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>



<div class="video-hero js-video-wrap">
  <?php

  echo wp_video_shortcode([
    'src'     => esc_url( $mp4 ),
    'webm'    => esc_url( $webm ),
    'poster'  => esc_url( $poster ),
    'preload' => 'metadata',
 
  ]);
  ?>
  <button class="video-play" aria-label="Play video">
   
    <svg viewBox="0 0 60 60" width="64" height="64" aria-hidden="true" focusable="false">
      <circle cx="30" cy="30" r="28" fill="rgba(0,0,0,.45)"/>
      <polygon points="24,18 24,42 44,30" fill="#fff"/>
    </svg>
  </button>
</div>


<!-- Image sections -->
<!-- <section class="house-image-col">
  <div class="house-image">
    <?php $house_img = get_template_directory_uri() . '/assets/images/Rectangle 36.png'; ?>
    <img src="<?php echo esc_url( $house_img ); ?>" alt="Residential pool and courtyard">
  </div>
</section> -->


<?php get_footer(); ?>

<script>
(function(){

  const wrap = document.getElementById('newsCarousel');
  if (!wrap) return;

  const prev = document.querySelector('.news-prev');
  const next = document.querySelector('.news-next');

  const scrollAmount = () => {
    const w = wrap.clientWidth;
    return Math.max( Math.floor(w * 0.9), 300 );
  };

  if (prev) {
    prev.addEventListener('click', () => {
      wrap.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
    });
  }

  if (next) {
    next.addEventListener('click', () => {
      wrap.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
    });
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft' && prev) prev.click();
    if (e.key === 'ArrowRight' && next) next.click();
  });
})();


(function(){
  function init(){
    document.querySelectorAll('.js-video-wrap').forEach(function(wrap){
      var video = wrap.querySelector('video');
      var btn   = wrap.querySelector('.video-play');
      if (!video || !btn) return;

   
      video.removeAttribute('controls');
      wrap.classList.remove('is-playing');

      function showControlsAndPlay(){
        video.setAttribute('controls','controls');
        wrap.classList.add('is-playing');
        video.play().catch(function(){});
      }

      btn.addEventListener('click', showControlsAndPlay);

      video.addEventListener('play', function(){
        video.setAttribute('controls','controls');
        wrap.classList.add('is-playing');
      });

  
      ['pause','ended'].forEach(function(ev){
        video.addEventListener(ev, function(){
          video.removeAttribute('controls');
          wrap.classList.remove('is-playing');
        });
      });
    });
  }


  if (document.readyState === 'complete') init();
  else window.addEventListener('load', init);
})();
</script>
