<?php
/**
 * Footer - Bootstrap Icons + TikTok fallback
 * Replace your existing footer.php with this file.
 *
 * This version always outputs the Contact Us lines (using theme options when available,
 * otherwise falling back to the requested static values).
 */
?>

<footer class="site-footer">
  <div class="container-fluid">
    <div class="row align-items-start py-5">

      <!-- CONTACT -->
      <div class="col-12 col-md-4 mb-4 mb-md-0">
        <?php

          $phone_opt  = function_exists('carbon_get_theme_option') ? carbon_get_theme_option('northgate_phone_1') : '';
          $phone      = $phone_opt ? $phone_opt : '+263 779 227 037';

      
          $tel_digits = preg_replace('/\D+/', '', $phone);

          $email_opt  = function_exists('carbon_get_theme_option') ? carbon_get_theme_option('northgate_email') : '';
          $email      = $email_opt ? $email_opt : 'info@northgate.co.zw';

          $address_opt = function_exists('carbon_get_theme_option') ? carbon_get_theme_option('northgate_address') : '';
          $address     = $address_opt ? $address_opt : '5 Campbell Rd Pomona, Borrowdale, Harare, Zimbabwe';

          $wa_link = $tel_digits ? 'https://wa.me/' . $tel_digits : '';

          $tel_attr   = $tel_digits ? esc_attr( $tel_digits ) : '';
          $tel_href   = $tel_digits ? 'tel:' . $tel_attr : '#';
          $wa_href    = $wa_link ? esc_url( $wa_link ) : '#';
          $mail_href  = $email ? 'mailto:' . antispambot( $email ) : '#';
        ?>

        <h5 class="footer-heading">Contact Us</h5>

        <ul class="list-unstyled footer-contact mb-0">
        
          <li class="mb-2">
            <a href="<?php echo esc_attr( $tel_href ); ?>">
              <i class="bi bi-telephone-fill footer-icon" aria-hidden="true"></i>
              <span><?php echo esc_html( $phone ); ?></span>
            </a>
          </li>

       
          <li class="mb-2">
            <a href="<?php echo $wa_href; ?>" target="_blank" rel="noopener">
              <i class="bi bi-whatsapp footer-icon" aria-hidden="true"></i>
              <span><?php echo esc_html( $phone ); ?></span>
            </a>
          </li>

      
          <li class="mb-2">
            <a href="<?php echo esc_attr( $mail_href ); ?>">
              <i class="bi bi-envelope-fill footer-icon" aria-hidden="true"></i>
              <span><?php echo esc_html( $email ); ?></span>
            </a>
          </li>

         
          <li class="address">
            <i class="bi bi-geo-alt-fill footer-icon" aria-hidden="true"></i>
            <div><small><?php echo esc_html( $address ); ?></small></div>
          </li>
        </ul>
      </div>

     
      <div class="col-6 col-md-2 mb-4 mb-md-0">
        <h5 class="footer-heading">Links</h5>
        <ul class="list-unstyled footer-links mb-0">
          <li><a href="<?php echo esc_url( home_url('/') ); ?>">Home</a></li>
          <li><a href="<?php echo esc_url( home_url('/residential-2') ); ?>">Residential</a></li>
          <li><a href="<?php echo esc_url( home_url('/how-to-buy') ); ?>">How to buy</a></li>
          <li><a href="<?php echo esc_url( home_url('/view-homes') ); ?>">View Homes</a></li>
        </ul>
      </div>

     
<div class="col-6 col-md-3 mb-4 mb-md-0">
  <h5 class="footer-heading">Social Media</h5>
  <ul class="list-unstyled social-list d-flex mb-0 gap-3">
    <?php
    
      $x_url  = 'https://x.com/northgatezim';
      $fb_url = 'https://www.facebook.com/northgatezim';
      $ig_url = 'https://www.instagram.com/northgateestates';

    
      $li_url = function_exists('carbon_get_theme_option')
        ? carbon_get_theme_option('zifa_website_custom_li')
        : '';

      $social = [
        ['url' => $x_url,  'label' => 'Follow us on X',          'icon' => 'bi-twitter-x'],
        ['url' => $fb_url, 'label' => 'Like us on Facebook',     'icon' => 'bi-facebook'],
        ['url' => $ig_url, 'label' => 'Follow us on Instagram',  'icon' => 'bi-instagram'],
        ['url' => $li_url, 'label' => 'Connect with us on LinkedIn', 'icon' => 'bi-linkedin'],
      ];

      foreach ($social as $s) {
        if (empty($s['url'])) continue; ?>
        <li class="mb-2">
          <a class="social-icon"
             href="<?php echo esc_url($s['url']); ?>"
             target="_blank" rel="noopener noreferrer"
             aria-label="<?php echo esc_attr($s['label']); ?>">
            <i class="bi <?php echo esc_attr($s['icon']); ?> footer-icon" aria-hidden="true"></i>
            <span class="visually-hidden"><?php echo esc_html($s['label']); ?></span>
          </a>
        </li>
    <?php } ?>
  </ul>
</div>


      <!-- LOGO / RIGHT -->
      <div class="col-12 col-md-3 text-md-end">
        <?php
          $logo = get_stylesheet_directory_uri() . '/assets/images/logo-white.svg';
        ?>
        <div class="footer-logo-wrap">
          <a href="<?php echo esc_url( home_url('/') ); ?>" class="d-inline-block" aria-label="<?php bloginfo('name'); ?>">
            <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo('name'); ?> logo" class="footer-logo" />
          </a>
        </div>
      </div>

    </div>
  </div> 
</footer>

<?php wp_footer(); ?>
</body>
</html>
