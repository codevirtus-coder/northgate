<?php
/**
 * banner.php
 *
 * Dynamic banner: chooses headline + bg image based on context (front page, singular, term archive, 404, etc).
 * Replace your existing banner block with this.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$default_bg = get_stylesheet_directory_uri() . '';

function rv_get_image_url( $val ) {
    if ( ! $val ) {
        return '';
    }
   
    if ( is_numeric( $val ) ) {
        $url = wp_get_attachment_url( (int) $val );
        if ( $url ) {
            return $url;
        }
    }
   
    if ( is_string( $val ) && filter_var( $val, FILTER_VALIDATE_URL ) ) {
        return $val;
    }
    return '';
}

$bg_image = $default_bg;
$headline = 'A House Plan that suits you';

$queried_id = get_queried_object_id();
$queried_obj = get_queried_object();


if ( is_front_page() || is_home() ) {
  
    if ( function_exists( 'carbon_get_theme_option' ) ) {
        $opt_img = rv_get_image_url( carbon_get_theme_option( 'north_gate_image' ) );
        $opt_head = carbon_get_theme_option( 'home_banner_headline' );
        if ( $opt_img ) {
            $bg_image = $opt_img;
        }
        if ( $opt_head ) {
            $headline = $opt_head;
        } else {
           
            $headline = get_bloginfo( 'name' );
        }
    } else {
        $headline = get_bloginfo( 'name' );
    }
}

elseif ( is_singular() ) {
    
    if ( function_exists( 'carbon_get_post_meta' ) && $queried_id ) {
        $post_img = rv_get_image_url( carbon_get_post_meta( $queried_id, 'banner_image' ) );
        $post_head = carbon_get_post_meta( $queried_id, 'banner_headline' );
        if ( $post_img ) {
            $bg_image = $post_img;
        } elseif ( has_post_thumbnail( $queried_id ) ) {
            $thumb = get_the_post_thumbnail_url( $queried_id, 'full' );
            if ( $thumb ) {
                $bg_image = $thumb;
            }
        } elseif ( function_exists( 'carbon_get_theme_option' ) ) {
            $opt_img = rv_get_image_url( carbon_get_theme_option( 'north_gate_image' ) );
            if ( $opt_img ) {
                $bg_image = $opt_img;
            }
        }

        $headline = $post_head ? $post_head : get_the_title( $queried_id );
    } else {
       
        if ( has_post_thumbnail( $queried_id ) ) {
            $thumb = get_the_post_thumbnail_url( $queried_id, 'full' );
            if ( $thumb ) {
                $bg_image = $thumb;
            }
        } elseif ( function_exists( 'carbon_get_theme_option' ) ) {
            $opt_img = rv_get_image_url( carbon_get_theme_option( 'north_gate_image' ) );
            if ( $opt_img ) {
                $bg_image = $opt_img;
            }
        }
        $headline = get_the_title( $queried_id );
    }
}

elseif ( is_category() || is_tag() || is_tax() ) {
    $term_head = '';
    $term_img = '';
    if ( $queried_obj && ! empty( $queried_obj->term_id ) ) {
        $term_id = $queried_obj->term_id;
      
        if ( function_exists( 'carbon_get_term_meta' ) ) {
            $term_img = rv_get_image_url( carbon_get_term_meta( $term_id, 'banner_image' ) );
            $term_head = carbon_get_term_meta( $term_id, 'banner_headline' );
        }
       
        $headline = $term_head ? $term_head : single_term_title( '', false );
        if ( $term_img ) {
            $bg_image = $term_img;
        } elseif ( function_exists( 'carbon_get_theme_option' ) ) {
            $opt_img = rv_get_image_url( carbon_get_theme_option( 'north_gate_image' ) );
            if ( $opt_img ) $bg_image = $opt_img;
        }
    } else {
        $headline = get_the_archive_title();
    }
}

elseif ( is_post_type_archive() || is_archive() ) {
   
    $headline = post_type_archive_title( '', false ) ?: get_the_archive_title();
    if ( function_exists( 'carbon_get_theme_option' ) ) {
        $opt_img = rv_get_image_url( carbon_get_theme_option( 'north_gate_image' ) );
        if ( $opt_img ) {
            $bg_image = $opt_img;
        }
    }
}

elseif ( is_404() ) {
    $headline = 'Page Not Found';
    if ( function_exists( 'carbon_get_theme_option' ) ) {
        $img = rv_get_image_url( carbon_get_theme_option( '404_banner_image' ) );
        if ( $img ) $bg_image = $img;
    }
}

if ( empty( $bg_image ) ) {
    $bg_image = $default_bg;
}
?>

<section class="site-banner hero-centered" role="banner" aria-label="<?php echo esc_attr( $headline ); ?>" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');">
  <div class="overlay" aria-hidden="true"></div>

  <div class="container">
    <div class="banner-inner d-flex align-items-center justify-content-center text-center">
      <div class="banner-content">
        <h1 class="banner-title"><?php echo esc_html( $headline ); ?></h1>
      </div>
    </div>
  </div>
</section>
