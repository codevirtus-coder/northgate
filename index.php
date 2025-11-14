<?php get_header(); ?>

<?php get_template_part( 'banners/allpage-banner' ); ?>

  <div class="container-fluid"> 
    <div class="row ">

      <div class="col-12">
        <?php the_content(); ?>
      </div>

    </div>
  </div>
  
<?php get_footer(); ?>
