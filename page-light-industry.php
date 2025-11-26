<?php
/**
 * front-page.php
 * Static front page template.
 */
get_header();
get_template_part( 'banners/allpage-banner' );
?>

<div class="container-fluid">
  <?php the_content();?>
</div>

<?php get_footer(); ?>