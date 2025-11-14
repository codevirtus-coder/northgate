<?php
// single.php
get_header();
get_template_part( 'banners/news-banner' );


if ( have_posts() ) :
  while ( have_posts() ) : the_post(); ?>
    <main class="container py-5">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="post-header">
          <!-- <h1><?php the_title(); ?></h1> -->
          <!-- <div class="post-meta">Published: <?php echo get_the_date(); ?></div> -->
          <!-- <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-featured-image"><?php the_post_thumbnail('large'); ?></div>
          <?php endif; ?> -->
        </header>
        <div class="post-content">
          <?php the_content(); ?>
        </div>
      </article>
    </main>
  <?php endwhile;
endif;
get_footer();
