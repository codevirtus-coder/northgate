<?php get_header(); ?>

<?php get_template_part( 'banners/allpage-banner' ); ?>

  <div class="container-fluid"> 
    <div class="row ">

      <div class="col-12">
        <h1>Page Not Found</h1>
        <a href="<?php echo esc_url( home_url('/') ); ?>"></a>
      </div>

    </div>
  </div>
  
<?php get_footer(); ?>
