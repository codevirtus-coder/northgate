<?php
get_header();
get_template_part( 'banners/allpage-banner' );
?>

<section class="section-retail">
  <div class="container-fluid">
    <div class="retail-grid">
      <div class="retail-copy">
        <h2 class="section-heading">Retail &amp; Hospitality Vision</h2>

        <p class="section-lead">
          We aim to challenge the norms of the typical design for these buildings in a cost-effective way,
          creating buildings that are more unique, exciting, and aspirational.
        </p>

        <p class="section-lead">Our Northgate Estates retail area will include:</p>

        <ul class="retail-list">
          <li>Malls</li>
          <li>Shops</li>
          <li>Corner Shops</li>
          <li>Market areas</li>
          <li>Hotel / Motel</li>
        </ul>
      </div>

      <figure class="retail-media">
        <img
          src="<?php echo esc_url( $map_image ?? get_template_directory_uri() . '/assets/plans/Retail-Hospitality-Distribution_maps.jpg' ); ?>"
          alt="Illustrative masterplan map of Northgate Estates"
          loading="lazy"
          decoding="async"
        />
      </figure>
    </div>
  </div>
</section>


<?php get_footer(); ?>