<?php
/**
 * banner.php
*/

$static_bg = get_stylesheet_directory_uri() . '/assets/img/banner.png';

if ( is_singular() && has_post_thumbnail() ) {
    $thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    if ( $thumb ) {
        $static_bg = $thumb;
    }
}

if ( function_exists( 'carbon_get_theme_option' ) ) {
    $cr_img = carbon_get_theme_option( 'north_gate_image' );
    if ( $cr_img ) {
        $static_bg = $cr_img;
    }
}

$slider_args = array(
    'post_type'      => 'northgate-slider',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
);

$slides = get_posts( $slider_args );

$default_headline = 'Where life finds its space';
$global_headline  = function_exists( 'carbon_get_theme_option' ) ? carbon_get_theme_option( 'northgate_headline' ) : '';
$headline = $global_headline ? $global_headline : $default_headline;

if ( $slides && is_array( $slides ) && count( $slides ) > 0 ) : ?>
  <section class="site-banner hero-centere" role="banner" aria-label="<?php echo esc_attr( $headline ); ?>">
    <div class="banner-content"> 
    <div class="overlay" aria-hidden="true"></div>
    <div id="northgateHeroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="false">
      <?php if ( count( $slides ) > 1 ) : ?>
        <div class="carousel-indicators">
          <?php foreach ( $slides as $idx => $post ) : ?>
            <button type="button" data-bs-target="#northgateHeroCarousel" data-bs-slide-to="<?php echo (int) $idx; ?>" <?php echo $idx === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="<?php echo 'Slide ' . ( $idx + 1 ); ?>"></button>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <div class="carousel-inner">
        <?php foreach ( $slides as $index => $post ) :
         
          setup_postdata( $post );
         
          $img_url = get_the_post_thumbnail_url( $post->ID, 'full' );
      
          if ( empty( $img_url ) && function_exists( 'carbon_get_post_meta' ) ) {
              $maybe = carbon_get_post_meta( $post->ID, 'slide_image' );
              if ( ! empty( $maybe ) ) {
                  $img_url = $maybe;
              }
          }
    
          if ( empty( $img_url ) ) {
              $img_url = $static_bg;
          }
        
          $slide_cta_text = function_exists( 'carbon_get_post_meta' ) ? carbon_get_post_meta( $post->ID, 'slider_btn_text' ) : '';
          $slide_cta_url  = function_exists( 'carbon_get_post_meta' ) ? carbon_get_post_meta( $post->ID, 'slider_btn_url' ) : '';
        
          $slide_headline = function_exists( 'carbon_get_post_meta' ) ? carbon_get_post_meta( $post->ID, 'slider_home_text' ) : '';
          $headline_to_show = $slide_headline ? $slide_headline : $headline;
        
          $bg_style = 'background-image: url(' . esc_url( $img_url ) . '); background-position: center; background-size: cover;';
        ?>
          <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
            <div class="banner-slider" style="<?php echo $bg_style; ?>">
              <div class="overlay" aria-hidden="true"></div>
              <div class="container">
                <div class="banner-inner d-flex align-items-center justify-content-center text-center">
                <div class="banner-centered">
                 <div class="banner-content">
                    <h1 class="banner-title"><?php echo esc_html( $headline_to_show ); ?></h1>
                    <?php if ( ! empty( $slide_cta_text ) && ! empty( $slide_cta_url ) ) : ?>
                      <p class="btn-primary mt-5">
                        <a class="btn-cta" href="<?php echo esc_url( $slide_cta_url ); ?>"><?php echo esc_html( $slide_cta_text ); ?></a>
                      </p>
                    <?php endif; ?>
                  </div>
                  </div>
               </div>
              </div>
            </div>
          </div>
        <?php
        endforeach;
        wp_reset_postdata();
        ?>
      </div>
    </div>
    </div>
  </section>
<?php

else : 
 
  ?>
  <section class="site-banner hero-centered" role="banner" aria-label="<?php echo esc_attr( $headline ); ?>" style="background-image: url('<?php echo esc_url( $static_bg ); ?>');">
    <div class="overlay" aria-hidden="true"></div>
    <div class="container">
      <div class="banner-inner d-flex align-items-center justify-content-center text-center">
        <div class="banner-content">
          <h1 class="banner-title"><?php echo esc_html( $headline ); ?></h1>
        </div>
      </div>
    </div>
  </section>
<?php
endif;
