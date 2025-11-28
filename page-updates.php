<?php

get_header();
get_template_part('banners/allpage-banner');

$paged = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );

$news_query = new WP_Query( array(
  'post_type'           => 'post',
  'post_status'         => 'publish',
  'category_name'       => 'news',    
  'posts_per_page'      => 8,         
  'paged'               => $paged,
  'ignore_sticky_posts' => true,
) );
?>

<section class="container-fluid news-archive-section py-5">
    <?php if ( $news_query->have_posts() ) : ?>
      <div class="news-archive-grid">
        <?php while ( $news_query->have_posts() ) : $news_query->the_post(); 
          $img = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: get_template_directory_uri() . '/assets/images/home-image-1.jpg';
          $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 20, '...' );
        ?>
      <article class="news-archive-card">
      <a href="<?php the_permalink(); ?>">
        <div class="news-archive-thumb" style="background-image:url('<?php echo esc_url( $img ); ?>')"></div>
        <div class="news-archive-body">
          <h3 class="section-lead-news-heading"><?php echo esc_html( get_the_title() ); ?></h3>
           <time class="news-date" datetime="<?php echo esc_attr( get_the_date('c') ); ?>">
        <?php echo esc_html( get_the_date() ); ?>
      </time>
           <!-- SHOW the excerpt (this was commented out) -->
      <p class="section-lead text-news-muted mb-4"><?php echo esc_html( $excerpt ); ?></p>
        <div class ="btn-news-bottom">
                  <p class="btn-secondary">READ MORE</p>
           </div>
        </div>
      </a>
      
  </a>
    </article>
        <?php endwhile; ?>
      </div>
      <!-- Pagination -->
      <nav class="news-pagination mt-4" aria-label="News Pagination">
        <?php
        $big = 999999999;
        $paginate_links = paginate_links( array(
          'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format'    => ( get_option('permalink_structure') ? 'page/%#%/' : '?paged=%#%' ),
          'current'   => max( 1, $paged ),
          'total'     => $news_query->max_num_pages,
          'mid_size'  => 1,
          'type'      => 'array',
          'prev_text' => '&laquo; Prev',
          'next_text' => 'Next &raquo;',
        ) );

        if ( is_array( $paginate_links ) ) : ?>
          <ul class="pagination-list" style="list-style:none;display:flex;gap:.5rem;padding:0;margin:0;">
            <?php foreach( $paginate_links as $link ) : ?>
              <li><?php echo wp_kses_post( $link ); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </nav>

    <?php else: ?>
      <div class="no-news mt-3">
        <p class="muted">No news found. Try publishing a post in the <strong>News</strong> category.</p>
      </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
</section>


<?php get_footer(); ?>


