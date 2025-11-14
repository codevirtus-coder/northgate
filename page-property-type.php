<?php
/**
 * front-page.php
 * Static front page template.
 */

get_header();
get_template_part( 'property-banner' );
?>


<?php

$floor1 = get_stylesheet_directory_uri() . '/assets/images/home-image-1.jpg';
$floor2 = get_stylesheet_directory_uri() . '/assets/images/home-image-1.jpg';


$items = [
  ['label' => 'Covered Patio',     'value' => '484 sq.m'],
  ['label' => 'Covered Entrance',  'value' => '484 sq.m'],
  ['label' => 'Dining Room',       'value' => '484 sq.m'],
  ['label' => 'Living Room',       'value' => '484 sq.m'],
  ['label' => 'Kitchen',           'value' => '484 sq.m'],
];
$total_label = 'TOTAL PRICE';
$total_price = '$450 000.00';
?>
<section class="house-layout-section">
  <div class="house-layout-inner container">

    <!-- LEFT: floor image + tabs -->
    <div class="house-left" aria-labelledby="house-layout-title">
      <div class="floor-tabs" role="tablist" aria-label="Floor selector">
        <button id="tab-floor-1" class="floor-tab is-active" role="tab" aria-selected="true" aria-controls="panel-floor-1">1st Floor</button>
        <button id="tab-floor-2" class="floor-tab" role="tab" aria-selected="false" aria-controls="panel-floor-2">2nd Floor</button>
      </div>

      <div class="floor-frames">
        <div id="panel-floor-1" class="floor-panel is-visible" role="tabpanel" aria-labelledby="tab-floor-1">
          <div class="floor-image-frame">
            <img src="<?php echo esc_url( $floor1 ); ?>" alt="First floor plan" />
          </div>
        </div>

        <div id="panel-floor-2" class="floor-panel" role="tabpanel" aria-labelledby="tab-floor-2" hidden>
          <div class="floor-image-frame">
            <img src="<?php echo esc_url( $floor2 ); ?>" alt="Second floor plan" />
          </div>
        </div>
      </div>
    </div>

    <!-- RIGHT: layout details -->
    <div class="house-right">
      <h2 id="house-layout-title" class="house-layout-title">House Layout</h2>

      <ul class="layout-list" role="list">
        <?php foreach ( $items as $it ) : ?>
          <li class="layout-item">
            <span class="layout-label"><?php echo esc_html( $it['label'] ); ?></span>
            <span class="layout-value"><?php echo esc_html( $it['value'] ); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>

      <div class="layout-total">
        <span class="total-label"><?php echo esc_html( $total_label ); ?></span>
        <span class="total-value"><?php echo esc_html( $total_price ); ?></span>
      </div>
    </div>
  </div>

  <!-- Image sections -->
  <section class="house-image-col">
      <div class="house-image">
    <?php
      $house_img = get_template_directory_uri() . '/assets/images/northgate-house-home.png';
    ?>
    <img src="<?php echo esc_url( $house_img ); ?>" alt="Residential pool and courtyard">
  </div>
</section>

<section class="stand-section" aria-labelledby="stand-heading">
  <div class="stand-inner container">
  
    <div class="stand-left">
      <h2 id="stand-heading" class="stand-title">400 sqm Stands</h2>

      <p class="stand-intro">
        The largest proportion of the residential component within Northgate Estates, is 400sqm stands,
        which provide the perfect opportunity for first time, entry-level homes, which are affordable,
        but spacious, neat and modern investments, that people are proud to call theirs, and which they
        will always remain fond of.
      </p>

      <?php
$icon_house = get_stylesheet_directory_uri() . '/assets/images/Group 67.png';
$icon_tree  = get_stylesheet_directory_uri() . '/assets/images/Group 68.png';
$icon_bed   = get_stylesheet_directory_uri() . '/assets/images/Group 69.png';
$icon_pool  = get_stylesheet_directory_uri() . '/assets/images/Group 70.png';
?>
<ul class="stand-features" aria-label="Property features">
  <li class="feature">
    <img class="feature-icon" src="<?php echo esc_url( $icon_house ); ?>" alt="Property type icon" width="34" height="34" />
    
  </li>

  <li class="feature">
    <img class="feature-icon" src="<?php echo esc_url( $icon_tree ); ?>" alt="Green spaces icon" width="34" height="34" /> 
  </li>

  <li class="feature">
    <img class="feature-icon" src="<?php echo esc_url( $icon_bed ); ?>" alt="Accommodation icon" width="34" height="34" />
  </li>

  <li class="feature">
    <img class="feature-icon" src="<?php echo esc_url( $icon_pool ); ?>" alt="Activity icon" width="34" height="34" />
</ul>


      <div class="stand-cta">
        <a class="btn-stand" href="#" role="button">BUY STAND</a>
      </div>
    </div>

    <div class="stand-right" aria-hidden="false">
  <div class="stand-image-frame">
    <?php
     
      $stand_image = get_stylesheet_directory_uri() . '/assets/images/northgate-house-home.png';
    ?>
    <img src="<?php echo esc_url( $stand_image ); ?>" alt="400 sqm stand illustration" />
  </div>
</div>

  </div>
</section>


<section class="front-page container">
<div class="news-section">
 <div class="news-header">
      <h2 class=" property-heading ">3D Renders of the 400 sqm Stands</h2>
      <div class="news-nav">
        <button class="news-prev" aria-label="Previous">&lsaquo;</button>
        <button class="news-next" aria-label="Next">&rsaquo;</button>
      </div>
    </div>

    <div class="news-carousel" id="newsCarousel">
      <?php
      $news = new WP_Query( array( 'posts_per_page' => 4 ) );
      if ( $news->have_posts() ) :
        while ( $news->have_posts() ) : $news->the_post();
          $img = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: get_template_directory_uri() . '/assets/images/Rectangle 12.png';
          ?>
          <article class="news-card-property">       
              <div class="news-thumb-property" style="background-image:url('<?php echo esc_url( $img ); ?>')"></div>             
          </article>
          <?php
        endwhile;
        wp_reset_postdata();
      else:
        for ( $i = 1; $i <= 4; $i++ ) : ?>
          <article class="news-card-property">
            <a href="#">
              <div class="news-thumb-property" style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/cluster<?php echo $i; ?>.jpg')"></div>
              
          </a>
          </article>
        <?php endfor;
      endif;
      ?>
    </div>
</div>
  </section>
</section>

<?php get_footer(); ?>
