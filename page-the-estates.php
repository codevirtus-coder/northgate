<?php

get_header();
get_template_part('banners/allpage-banner');

?>


<section class="featured-tiles" aria-label="Featured categories">
  <div class="container-icons"> 
    <div class="tiles-grid-1">
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
        
        <a class="tile-1" href="<?php echo esc_url( $url ); ?>">  
          
        
        <div class="image-div">
          <img
            src="<?php echo esc_url( $img_url ); ?>"
            alt="<?php echo esc_attr( $t['label'] ); ?>"
            class="tile-image-1"
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


<?php get_footer(); ?>
