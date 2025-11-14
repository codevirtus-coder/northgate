<?php
/**
 * front-page.php
 * Static front page template.
 */
get_header();
get_template_part( 'banners/allpage-banner' );
?>


<section class="section-retail">
  <div class="container-fluid">
    <div class="retail-grid">
      <div class="retail-copy">
        <h2 class="section-heading">Adding &amp; Diversity Vision</h2>

        <p class="section-lead">
          Light industrial developments add diversity to an economy by creating jobs, fostering innovation, enhancing skill development, and promoting balanced regional growth. Their presence contributes to a more resilient and dynamic economy that can better withstand external shocks and capitalize on emerging opportunities.
          We believe that applying universally good architectural thinking when it comes to designing even light industrial spaces, results in better buildings, better economics and healthier happier environments and end-users.
        </p>

        <p class="section-lead">Our Northgate Estates Light Industrial Component Includes:</p>

        <ul class="retail-list">
            <li>Mini Factories</li>
          <li>Malls</li>
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


<section class="section-retail">
  <div class="container-fluid">
    <div class="retail-gri">
      <div class="retail-copy">
        <h2 class="section-heading"> Places for People</h2>

        <p class="section-lead">
          Our architecture will also foster social interaction, participation, and inclusion,
          which can strengthen the sense of belonging and ownership in community members, influencing 
          the quality of relationships within a community, and the daily lives of these individuals.
        </p>

        <p class="section-lead">  Other inclusions here will include:</p>

        <ul class="retail-list">
          <li>Civic</li>
          <li>Places of Worship</li> 
           <li>Parks and Recreation</li>
           <li>Education</li>
        </ul>
        
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>