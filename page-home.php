<?php


get_header();
get_template_part( 'banners/banner-slider' );
$poster = get_template_directory_uri() . '/assets/images/Rectangle 36.png';
$mp4    = get_template_directory_uri() . '/assets/video/video.mp4';
$webm   = get_template_directory_uri() . '/assets/video/hero.webm';
?>

<?php the_content();?>
  
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
            <p class="section-lead muted mb-4"><?php echo esc_html( $excerpt ); ?></p>
           <div class ="btn-news-bottom">
                  <p class="btn-secondary">READ MORE</p>
           </div>
         
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
  <div class="container-fluid"> 
    <div class="tiles-grid">
      <?php
      $tiles = array(
        array('img' => 'play.svg', 'label' => 'PLAY'),
        array('img' => 'shop.svg', 'label' => 'SHOP'),
        array('img' => 'work.svg', 'label' => 'WORK'),
        array('img' => 'stay.svg', 'label' => 'STAY'),
        array('img' => 'health.svg', 'label' => 'HEALTH'),
        array('img' => 'travel.svg', 'label' => 'TRAVEL'),
      );

      foreach ( $tiles as $t ) {
        $img_url = get_template_directory_uri() . '/assets/images/icons/' . $t['img'];

// Parent slug
$parent_slug = 'the-estates';

// Child slug from label: PLAY -> play
$child_slug = sanitize_title( $t['label'] );

// Try to find page with path "the-estates/play", etc.
$page = get_page_by_path( $parent_slug . '/' . $child_slug );

if ( $page ) {
    // Use real page permalink if it exists
    $url = get_permalink( $page->ID );
} else {
    // Fallback to /the-estates/play/
    $url = home_url( '/' . $parent_slug . '/' . $child_slug . '/' );
}

        ?>
        
        <a class="tile" href="<?php echo esc_url( $url ); ?>">   
        <div class="image">
          <img
            src="<?php echo esc_url( $img_url ); ?>"
            alt="<?php echo esc_attr( $t['label'] ); ?>"
            class="tile-image"
          />
        </div>
          <p class="tile-label"><?php echo esc_html( $t['label'] ); ?></p>
        </a>

        <?php
      }
      ?>
    </div>
  </div>
</section>


<section class="our-partners">
	<div class="container-fluid">

		<section class="row">
			<div class="col-12">
				  <h3 class="partners-title">OUR PROUD PARTNERS</h3>
			</div>
		</section>

<section class="row">
  <div class="col-12">
    <div class="zifaPartners swiper">
      <div class="swiper-wrapper">
        <?php
          $args = array(
            'post_type'      => 'partners-slider',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
          );
          $partner_query = new WP_Query($args);
        ?>

        <?php if ( $partner_query->have_posts() ) : ?>
          <?php while ( $partner_query->have_posts() ) : $partner_query->the_post(); ?>
            <div class="swiper-slide">
              <img
                class="partner-logo"
                src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>"
                alt="<?php the_title(); ?>"
              />
            </div>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


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


