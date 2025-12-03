<?php
  /* Template Name: AboutUs - Our Partners */
  get_header();
?>

<?php get_template_part('banners/allpage-banner'); ?>

<section class="house-layout-section">

  <?php
    // This page = PLAY group by default
    $selected_group = 'OUR_PARTNERS';

    $args = array(
      'post_type'      => 'aboutUs',
      'posts_per_page' => -1,
      'post_status'    => 'publish',
      'orderby'        => 'menu_order',
      'order'          => 'ASC',
      'meta_query'     => array(
        array(
          'key'     => 'about_group',   
          'value'   => $selected_group,
          'compare' => '='
        )
      ),
    );

    $shop_query = new WP_Query($args);

    // Collect all shops for the dropdown
    $shops = array();

    if ($shop_query->have_posts()) {
      while ($shop_query->have_posts()) {
        $shop_query->the_post();

        $shops[] = array(
          'id'    => get_the_ID(),
          'title' => get_the_title(),
          'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '',
          'intro' => carbon_get_post_meta(get_the_ID(), 'about_intro'),
        );
      }
      wp_reset_postdata();
    }
  ?>


</section>

<script>
(function(){
  'use strict';

  const picker   = document.querySelector('.shop-picker');
  if (!picker) return;

  const btn      = picker.querySelector('.plan-button');
  const labelEl  = picker.querySelector('.plan-button-label');
  const menu     = picker.querySelector('.plan-menu');
  const options  = menu ? Array.from(menu.querySelectorAll('.plan-option')) : [];
  const titleEl  = document.getElementById('shop-layout-title');
  const introEl  = document.getElementById('shop-intro-text');
  const imageEl  = document.getElementById('shop-main-image');

  const shops = <?php echo wp_json_encode($shops); ?> || [];
  if (!shops.length) return;

  function selectShop(index) {
    const shop = shops[index];
    if (!shop) return;

    picker.dataset.current = String(index);

    if (labelEl) labelEl.textContent = shop.title || 'Shop';
    if (titleEl) titleEl.textContent = shop.title || '';
    if (introEl) introEl.textContent = shop.intro || '';
    if (imageEl && shop.image) {
      imageEl.src = shop.image;
      imageEl.alt = shop.title || '';
    }

    options.forEach(o => {
      o.setAttribute('aria-selected', (o.dataset.index == index ? 'true' : 'false'));
    });
  }

  function openMenu() {
    menu.classList.add('is-open');
    btn.setAttribute('aria-expanded', 'true');
  }

  function closeMenu() {
    menu.classList.remove('is-open');
    btn.setAttribute('aria-expanded', 'false');
  }

  btn.addEventListener('click', () => {
    if (menu.classList.contains('is-open')) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  options.forEach(o => {
    o.addEventListener('click', () => {
      selectShop(parseInt(o.dataset.index, 10) || 0);
      closeMenu();
    });
  });

  document.addEventListener('click', (e) => {
    if (!picker.contains(e.target)) {
      closeMenu();
    }
  });

})();
</script>

<?php get_footer(); ?>
