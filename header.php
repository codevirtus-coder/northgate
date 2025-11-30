<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.png" />
  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header">
  <div class="top-bar">
    <div class="container-fluid d-flex flex-sm-row flex-column justify-content-between align-items-center">

      <div class="social-icons">
        <?php
        $x_url  = 'https://x.com/northgatezim';
        $fb_url = 'https://www.facebook.com/northgatezim';
        $ig_url = 'https://www.instagram.com/northgateestates';

        $li_url = carbon_get_theme_option('zifa_website_custom_li');

        $social = [
          ['url' => $x_url,  'label' => 'Follow us on X',              'icon' => 'bi-twitter-x'],
          ['url' => $fb_url, 'label' => 'Like us on Facebook',         'icon' => 'bi-facebook'],
          ['url' => $li_url, 'label' => 'Connect with us on LinkedIn', 'icon' => 'bi-linkedin'],
          ['url' => $ig_url, 'label' => 'Follow us on Instagram',      'icon' => 'bi-instagram'],
        ];

        foreach ($social as $s) {
          if (empty($s['url'])) continue;
          ?>
          <a class="social"
             href="<?php echo esc_url($s['url']); ?>"
             target="_blank" rel="noopener noreferrer"
             data-bs-toggle="tooltip" data-bs-placement="top"
             data-bs-title="<?php echo esc_attr($s['label']); ?>">
            <i class="bi <?php echo esc_attr($s['icon']); ?>" aria-hidden="true"></i>
            <span class="visually-hidden"><?php echo esc_html($s['label']); ?></span>
          </a>
          <?php
        }
        ?>
      </div>

      <?php if ( has_nav_menu('top_menu') ): ?>
        <?php
        wp_nav_menu( array(
          'theme_location' => 'top_menu',
          'container'      => false,
          'menu_class'     => 'top-menu d-flex mb-0',
          'fallback_cb'    => false,
          'depth'          => 1,
          'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        ) );
        ?>
      <?php endif; ?>

    </div>
  </div>

  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo-blue.svg' ); ?>" alt="northgate estates" />
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
              aria-controls="mainNavbar" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','zifa-mini'); ?>">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <?php
        wp_nav_menu( array(
          'theme_location' => 'main_menu',
          'container'      => false,
          'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0',
          'fallback_cb'    => false,
          'depth'          => 2,
          'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        ) );
        ?>
      </div>
    </div>
  </nav>
</header>

<?php
$preview_data = [];

// =========================================
// 1) Residential: designs → stands preview
// =========================================
$res_items = [];

$res_query = new WP_Query([
  'post_type'      => 'designs',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
]);

$size_links = [
  '400 Sqm'            => '/400-sqm-stands',
  '600 Sqm'            => '/600-sqm-stands',
  '1200 Sqm'           => '/1200-sqm-stands',
  'Cluster/Apartments' => '/cluster-apartments',
];

if ( $res_query->have_posts() ) {
  while ( $res_query->have_posts() ) {
    $res_query->the_post();

    $size = carbon_get_post_meta( get_the_ID(), 'design_sizes' );

    // Map each size to its stands page
    if ( $size && isset( $size_links[ $size ] ) ) {
      $target_url = home_url( $size_links[ $size ] );
    } else {
      $target_url = get_permalink();
    }

    // Thumb: first slider image > featured image > fallback
    $slider_images = carbon_get_post_meta( get_the_ID(), 'design_slider' );
    if ( ! empty( $slider_images ) && ! empty( $slider_images[0]['design_images'] ) ) {
      $thumb = $slider_images[0]['design_images'];
    } elseif ( has_post_thumbnail() ) {
      $thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
    } else {
      $thumb = get_stylesheet_directory_uri() . '/assets/images/stands/stand-placeholder.png';
    }

    $res_items[] = [
      'title' => $size ?: get_the_title(),
      'link'  => $target_url,
      'image' => $thumb,
    ];
  }
  wp_reset_postdata();
}

if ( $res_items ) {
  // This key must match your nav label "Residential"
  $preview_data['residential'] = ['items' => $res_items];
}



// =========================================
// 2) The Estates: shops → estates preview
// =========================================
$shop_items = [];

$shops_query = new WP_Query([
  'post_type'      => 'shops',
  'posts_per_page' => 4,
  'post_status'    => 'publish',
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
]);

if ( $shops_query->have_posts() ) {
  while ( $shops_query->have_posts() ) {
    $shops_query->the_post();

    // Thumb: featured image or fallback
    if ( has_post_thumbnail() ) {
      $thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
    } else {
      $thumb = get_stylesheet_directory_uri() . '/assets/images/stands/stand-placeholder.png';
    }

    $title = get_the_title();
    $slug  = sanitize_title( $title );


    $shop_items[] = [
      'title' => get_the_title(),   // shop name
       'link'  => home_url( '/' . $slug . '/' ),   // shop page
      'image' => $thumb,
    ];
  }
  wp_reset_postdata();
}

if ( $shop_items ) {
  // This key must match your menu label text.
  // If your nav item is literally "The Estates", this is correct:
  $preview_data['the estates'] = ['items' => $shop_items];

  // If your nav item is "Estates" only, use this instead:
  // $preview_data['estates'] = ['items' => $shop_items];
}
?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const previewData = <?php echo wp_json_encode( $preview_data ); ?>;
  if (!previewData || !Object.keys(previewData).length) return;

  const nav = document.querySelector('.navbar-nav');
  if (!nav) return;

  let card = document.getElementById('navPreviewCard');
  if (!card) {
    card = document.createElement('div');
    card.id = 'navPreviewCard';
    card.className = 'nav-preview-card';
    card.setAttribute('aria-hidden', 'true');
    document.body.appendChild(card);
  }

  let hideTimeout = null;

  function scheduleHide() {
    clearHide();
    hideTimeout = setTimeout(hideCard, 120);
  }

  function clearHide() {
    if (hideTimeout) {
      clearTimeout(hideTimeout);
      hideTimeout = null;
    }
  }

  function key(text) {
    return (text || '').trim().toLowerCase();
  }

  function buildGrid(items) {
    const wrap = document.createElement('div');
    wrap.className = 'nav-preview-grid';

    items.forEach(item => {
      const a = document.createElement('a');
      a.href = item.link || '#';
      a.className = 'nav-preview-card-item';
      a.innerHTML = `
        <img class="card-thumb" src="${item.image || ''}" alt="${item.title || ''}">
        <span class="card-title">${item.title || ''}</span>
      `;
      wrap.appendChild(a);
    });

    return wrap;
  }

  function showCard(linkEl) {
    const data = previewData[key(linkEl.textContent)];
    if (!data || !Array.isArray(data.items)) return;

    clearHide();

    card.innerHTML = '';
    card.appendChild(buildGrid(data.items));

    const rect = linkEl.getBoundingClientRect();
    card.style.top = (rect.bottom + 10) + 'px';
    card.style.left = '0';
    card.style.width = '100%';

    card.classList.add('show');
    card.setAttribute('aria-hidden', 'false');
  }

  function hideCard() {
    card.classList.remove('show');
    card.setAttribute('aria-hidden', 'true');
  }

  // Hook up nav links
  nav.querySelectorAll('a').forEach(link => {
    const k = key(link.textContent);
    if (!previewData[k]) return;

    link.addEventListener('mouseenter', () => showCard(link));
    link.addEventListener('focus',      () => showCard(link));
    link.addEventListener('mouseleave', scheduleHide);
    link.addEventListener('blur',       scheduleHide);
  });

  // Card hover keeps it open so you can click a card
  card.addEventListener('mouseenter', clearHide);
  card.addEventListener('mouseleave', scheduleHide);

  // Hide when scrolling
  window.addEventListener('scroll', function () {
    clearHide();
    hideCard();
  }, { passive: true });

  // Hide when clicking outside
  document.addEventListener('click', function (e) {
    if (!card.classList.contains('show')) return;

    const clickedInsideCard = card.contains(e.target);
    const clickedInsideNav  = nav.contains(e.target);

    if (!clickedInsideCard && !clickedInsideNav) {
      clearHide();
      hideCard();
    }
  });

  // Close with Escape
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
      clearHide();
      hideCard();
    }
  });
});
</script>
