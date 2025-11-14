<?php
/**
 * .php
 * Static front page template.
 */
get_header();
get_template_part( 'banners/allpage-banner' );
?>

<?php
$floor_plan_fallback  = get_stylesheet_directory_uri() . '/img/new-home.png';
$photo_image_fallback = get_stylesheet_directory_uri() . '/assets/images/northgate-house-home.png';

/**
 * Define plans by groups, then FLATTEN into ONE $plans array.
 * This keeps ONE dropdown but still lets you add/organize by stand size.
 */

/* ========================
   PLANS: 400 sqm (yours)
   ======================== */
$plans_400 = [
  [
    'stand_group' => '400',
    'type'        => 1,
    'area_sqm'    => 155,
    'title'       => '400 sqm Stands ( 1 – 155 sqm)',
    'plan_img'    => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-1-155-sqm.jpg',
    'photo_img'   => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-1-155-sqm-photo.png',
    'thumb'       => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-1-155-sqm-photo.png',
    'items'       => [
      ['label' => 'Covered Patio',     'value' => '19 Sqm'],
      ['label' => 'Covered Entrance',  'value' => '9 Sqm'],
      ['label' => 'Dining Room',       'value' => '19 Sqm'],
      ['label' => 'Living Room',       'value' => '17 Sqm'],
      ['label' => 'Kitchen',           'value' => '13 Sqm'],
      ['label' => 'Shared Bathroom',   'value' => '5 Sqm'],
      ['label' => 'Open Garage',       'value' => '—'],
      ['label' => 'Passage',           'value' => '8 Sqm'],
      ['label' => 'Main Bedroom',      'value' => '15 Sqm'],
      ['label' => 'Main Bathroom',     'value' => '4 Sqm'],
      ['label' => 'Bedroom 1',         'value' => '14 Sqm'],
      ['label' => 'Bedroom 2',         'value' => '15 Sqm'],
      ['label' => 'Garden',            'value' => '—'],
    ],
    'total_label' => 'TOTAL PRICE',
    'total_price' => '$450 000.00',
  ],
  [
    'stand_group' => '400',
    'type'        => 2,
    'area_sqm'    => 130,
    'title'       => '400 sqm Stands (2 – 130 sqm)',
    'plan_img'    => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-2-130-sqm.jpg',
    'photo_img'   => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-2-130-sqm-photo.png',
    'thumb'       => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-2-130-sqm-photo.png',
    'items'       => [
      ['label' => 'Covered Patio',    'value' => '13 Sqm'],
      ['label' => 'Covered Entrance', 'value' => '11 Sqm'],
      ['label' => 'Dining Room',      'value' => '9 Sqm'],
      ['label' => 'Living Room',      'value' => '18 Sqm'],
      ['label' => 'Kitchen',          'value' => '10 Sqm'],
      ['label' => 'Shared Bathroom',  'value' => '9 Sqm'],
      ['label' => 'Open Garage',      'value' => '—'],
      ['label' => 'Passage',          'value' => '5 Sqm'],
      ['label' => 'Bedroom 1',        'value' => '14 Sqm'],
      ['label' => 'Bedroom 2',        'value' => '15 Sqm'],
      ['label' => 'Bedroom 3',        'value' => '13 Sqm'],
      ['label' => 'Garden',           'value' => '—'],
    ],
    'total_label' => 'TOTAL PRICE',
    'total_price' => '$520 000.00',
  ],
];

/* ============================
   PLANS: 500–600 sqm (yours)
   ============================ */
$plans_500_600 = [
  [
    'stand_group' => '500-600',
    'type'        => 1,
    'area_sqm'    => 155,
    'title'       => '500–600 sqm Stands (1 – 155 sqm)',
    'plan_img'    => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-1-155-sqm.jpg',
    'photo_img'   => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-1-155-sqm-photo.png',
    'thumb'       => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-1-155-sqm-photo.png',
    'items'       => [
      ['label' => 'Covered Patio',     'value' => '19 Sqm'],
      ['label' => 'Covered Entrance',  'value' => '9 Sqm'],
      ['label' => 'Dining Room',       'value' => '19 Sqm'],
      ['label' => 'Living Room',       'value' => '17 Sqm'],
      ['label' => 'Kitchen',           'value' => '13 Sqm'],
      ['label' => 'Shared Bathroom',   'value' => '5 Sqm'],
      ['label' => 'Open Garage',       'value' => '—'],
      ['label' => 'Passage',           'value' => '8 Sqm'],
      ['label' => 'Main Bedroom',      'value' => '15 Sqm'],
      ['label' => 'Main Bathroom',     'value' => '4 Sqm'],
      ['label' => 'Bedroom 1',         'value' => '14 Sqm'],
      ['label' => 'Bedroom 2',         'value' => '15 Sqm'],
      ['label' => 'Garden',            'value' => '—'],
    ],
    'total_label' => 'TOTAL PRICE',
    'total_price' => 'TBA',
  ],
  [
    'stand_group' => '500-600',
    'type'        => 2,
    'area_sqm'    => 130,
    'title'       => '500–600 sqm Stands (2 – 130 sqm)',
    'plan_img'    => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-2-130-sqm.jpg',
    'photo_img'   => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-2-130-sqm-photo.png',
    'thumb'       => get_stylesheet_directory_uri() . '/assets/images/plans/House-type-2-130-sqm-photo.png',
    'items'       => [
      ['label' => 'Covered Patio',    'value' => '13 Sqm'],
      ['label' => 'Covered Entrance', 'value' => '11 Sqm'],
      ['label' => 'Dining Room',      'value' => '9 Sqm'],
      ['label' => 'Living Room',      'value' => '18 Sqm'],
      ['label' => 'Kitchen',          'value' => '10 Sqm'],
      ['label' => 'Shared Bathroom',  'value' => '9 Sqm'],
      ['label' => 'Open Garage',      'value' => '—'],
      ['label' => 'Passage',          'value' => '5 Sqm'],
      ['label' => 'Bedroom 1',        'value' => '14 Sqm'],
      ['label' => 'Bedroom 2',        'value' => '15 Sqm'],
      ['label' => 'Bedroom 3',        'value' => '13 Sqm'],
      ['label' => 'Garden',           'value' => '—'],
    ],
    'total_label' => 'TOTAL PRICE',
    'total_price' => 'TBA',
  ],
];

/* ============================
   PLANS: 1000 sqm (new)
   ============================ */
$plans_1000 = [
  [
    'stand_group' => '1000',
    'type'        => 6,
    'area_sqm'    => 355, 
    'title'       => '1000 sqm Stands — House Type 6A (Ground Floor, 200 sqm)',
    'plan_img'    => get_stylesheet_directory_uri() . '/assets/images/plans/House-Type-6-355-sqm.jpg',
    'photo_img'   => get_stylesheet_directory_uri() . '/assets/images/plans/House-Type-6-355-sqm-photo.png',
    'thumb'       => get_stylesheet_directory_uri() . '/assets/images/plans/House-Type-6-355-sqm-photo.png',
    'items'       => [
      ['label' => 'Ground Floor',            'value' => '200 Sqm'],
      ['label' => 'Living Room',             'value' => '31 Sqm'],
      ['label' => 'Kitchen',                 'value' => '13 Sqm'],
      ['label' => 'Dining Room',             'value' => '12 Sqm'],
      ['label' => 'Pantry',                  'value' => '5 Sqm'],
      ['label' => 'Entrance Lobby',          'value' => '6 Sqm'],
      ['label' => 'Scullery',                'value' => '9 Sqm'],
      ['label' => 'Mud Room',                'value' => '7 Sqm'],
      ['label' => 'Guest Wc',                'value' => '4 Sqm'],
      ['label' => 'Garages',                 'value' => '65 Sqm'],
      ['label' => 'Covered Patio',           'value' => '37 Sqm'],
      ['label' => 'Covered Entrance',        'value' => '4 Sqm'],
      ['label' => 'Open Patio',              'value' => '—'],
      ['label' => 'Pool & Deck',             'value' => '—'],
      ['label' => 'Garden Store',            'value' => '2 Sqm'],
    ],
    'total_label' => 'TOTAL PRICE',
    'total_price' => 'TBA',
  ],

  // --- Type 6B: First Floor only (155 sqm) ---
  [
    'stand_group' => '1000',
    'type'        => 6,
    'area_sqm'    => 355, // overall plan size (kept for ordering)
    'title'       => '1000 sqm Stands — House Type 6B (First Floor, 155 sqm)',
    'plan_img'    => get_stylesheet_directory_uri() . '/assets/images/plans/House-Type-6-355-sqm-First-Floor-155-sqm.jpg',
    'photo_img'   => get_stylesheet_directory_uri() . '/assets/images/plans/House-Type-6-355-sqm-First-Floor-155-sqm-photo.png',
    'thumb'       => get_stylesheet_directory_uri() . '/assets/images/plans/House-Type-6-355-sqm-First-Floor-155-sqm-photo.png',
    'items'       => [
      ['label' => 'First Floor',             'value' => '155 Sqm'],
      ['label' => 'Bedroom Lobby/ Passage',  'value' => '22 Sqm'],
      ['label' => 'Main Dressing Room 1',    'value' => '9 Sqm'],
      ['label' => 'Main Dressing Room 2',    'value' => '3 Sqm'],
      ['label' => 'Main Bedroom',            'value' => '10 Sqm'],
      ['label' => 'Main Bathroom',           'value' => '9 Sqm'],
      ['label' => 'Bedroom 2',               'value' => '13 Sqm'],
      ['label' => 'Bathroom 2',              'value' => '4 Sqm'],
      ['label' => 'Bedroom 3',               'value' => '13 Sqm'],
      ['label' => 'Bathroom 3',              'value' => '4 Sqm'],
      ['label' => 'Loft',                    'value' => '39 Sqm'],
      ['label' => 'Loft Bathroom',           'value' => '5 Sqm'],
      ['label' => 'Double Volume',           'value' => '35 Sqm'],
    ],
    'total_label' => 'TOTAL PRICE',
    'total_price' => 'TBA',
  ],
];




/* ==============================================
   PLANS: Cluster Housing & Courtyard Apartments
   ============================================== */
$plans_cluster = [
  [
    'stand_group' => 'cluster',
    'type'        => 3,
    'area_sqm'    => 165,
    'title'       => 'Cluster Housing - House Type 3 – 165 sqm',
    'plan_img'    => get_stylesheet_directory_uri() . '/assets/images/plans/House-Type-3-165-sqm-Ground-88-sqm-First-77-sqm.jpg',
    'photo_img'   => get_stylesheet_directory_uri() . '/assets/images/plans/House-Type-6-355-sqm-First-Floor-155-sqm-photo.png',
    'thumb'       => get_stylesheet_directory_uri() . '/assets/images/plans/House-Type-6-355-sqm-First-Floor-155-sqm-photo.png',
    'items'       => [
     
      ['label' => 'Ground / First',     'value' => 'Ground 88 Sqm / First 77 Sqm'],

  
      ['label' => 'Open Patio',         'value' => '20 Sqm'],
      ['label' => 'Covered Entrance',   'value' => '8 Sqm'],
      ['label' => 'Dining Room',        'value' => '17 Sqm'],
      ['label' => 'Living Room',        'value' => '27 Sqm'],
      ['label' => 'Kitchen',            'value' => '20 Sqm'],
      ['label' => 'Guest Wc',           'value' => '3 Sqm'],
      ['label' => 'Open Garage',        'value' => '—'],
      ['label' => 'Stair',              'value' => '3 Sqm'],
      ['label' => 'Garden',             'value' => '—'],
      ['label' => 'Bedroom Lobby',      'value' => '7 Sqm'],
      ['label' => 'Main Bedroom',       'value' => '17 Sqm'],
      ['label' => 'Main Bathroom',      'value' => '6 Sqm'],
      ['label' => 'Bedroom 1',          'value' => '12 Sqm'],
      ['label' => 'Bedroom 2',          'value' => '16 Sqm'],
      ['label' => 'Shared Bathroom',    'value' => '4 Sqm'],
    ],
    'total_label' => 'TOTAL PRICE',
    'total_price' => 'TBA',
  ],
];


$plans_all = array_merge($plans_400, $plans_500_600, $plans_1000, $plans_cluster);
usort($plans_all, function($a, $b){
  $order_group = ['400' => 1, '500-600' => 2, '1000' => 3, 'cluster' => 4];
  $ga = $order_group[$a['stand_group'] ?? '400'] ?? 99;
  $gb = $order_group[$b['stand_group'] ?? '400'] ?? 99;
  if ($ga !== $gb) return $ga <=> $gb;
  if (($a['type'] ?? 0) !== ($b['type'] ?? 0)) return ($a['type'] ?? 0) <=> ($b['type'] ?? 0);
  return ($b['area_sqm'] ?? 0) <=> ($a['area_sqm'] ?? 0);
});

// Use your existing $plans variable for the UI (single dropdown)
$plans = $plans_all;

// Fallbacks
foreach ($plans as $k => $p) {
  if ( empty($p['plan_img']) )  { $plans[$k]['plan_img']  = $floor_plan_fallback; }
  if ( empty($p['photo_img']) ) { $plans[$k]['photo_img'] = $photo_image_fallback; }
  if ( empty($p['thumb']) )     { $plans[$k]['thumb']     = $plans[$k]['photo_img']; }
}

/* =========================
   GROUP CONTENT for bottoms
   ========================= */
$group_content = [
  '400' => [
    'stand_title'        => '400 sqm Stands',
    'stand_intro'        => 'The largest proportion of the residential component within Northgate Estates, is 400sqm stands, which provide the perfect opportunity for first time, entry-level homes, which are affordable, but spacious, neat and modern investments, that people are proud to call theirs, and which they will always remain fond of.',
    'stand_image'        => get_stylesheet_directory_uri() . '/assets/images/stand-images/500-600-sqm.jpg',
    'property_heading'   => '3D Renders of the 400 sqm Stands',
    'renders_category'   => 'renders',
    'other_plans_heading'=> 'View Other<br>House Plans for 400sqm',
    'homes_category'     => 'homes',
  ],
  '500-600' => [
    'stand_title'        => '500–600 sqm Stands',
    'stand_intro'        => 'The residential component within Northgate Estates, also includes 500-600sqm stands, which are slightly larger than the 400sqm entry-level homes, with increases being mainly in terms of the sizes of the rooms.',
    'stand_image'        => get_stylesheet_directory_uri() . '/assets/images/stand-images/400-500-600-sqm.jpg',
    'property_heading'   => '3D Renders of the 500–600 sqm Stands',
    'renders_category'   => 'renders', 
    'other_plans_heading'=> 'View Other<br>House Plans for 500–600sqm',
    'homes_category'     => 'homes',
  ],
  '1000' => [
    'stand_title'        => '1000 sqm Stands',
    'stand_intro'        => 'The residential component within Northgate Estates, also includes a few larger stands of 1200sqm size. These stands provide the opportunity to build larger homes, while still having generous garden spaces, and perhaps more privacy where that may be a requirement.',
    'stand_image'        => get_stylesheet_directory_uri() . '/assets/images/stand-images/1000-sqm.jpg',
    'property_heading'   => '3D Renders of the 1000 sqm Stands',
    'renders_category'   => 'renders',
    'other_plans_heading'=> 'View Other<br>House Plans for 1000sqm',
    'homes_category'     => 'homes',
  ],
  'cluster' => [
    'stand_title'        => 'Cluster Housing & Courtyard Apartments',
    'stand_intro'        => 'Our idea is to create variety, dependent on the different stand allocation, some typical townhouse / cluster homes configured around courtyards whilst others reminiscent of classical courtyard apartment buildings.',
    'stand_image'        => get_stylesheet_directory_uri() . '/assets/images/stand-images/home_slider.jpg',
    'property_heading'   => '3D Renders: Cluster & Courtyard',
    'renders_category'   => 'renders',
    'other_plans_heading'=> 'View Other<br>Cluster & Courtyard Plans',
    'homes_category'     => 'homes',
  ],
];

/* Helpers to render your carousels/grids with same markup/classes */
function ng_render_renders_carousel($cat){
  ?>
  <div class="news-carousel" data-carousel-for="<?php echo esc_attr($cat); ?>">
    <?php
      $fallbacks = [
        get_template_directory_uri() . '/assets/images/Rectangle 23.png',
        get_template_directory_uri() . '/assets/images/Rectangle 12.png',
      ];
      $q = new WP_Query([
        'posts_per_page'      => 4,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
        'category_name'       => $cat,
      ]);

      $images = [];
      if ( $q->have_posts() ) {
        while ( $q->have_posts() ) {
          $q->the_post();
          $thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
          $images[] = $thumb ?: array_shift($fallbacks);
          if ( count($images) >= 4 ) break;
        }
        wp_reset_postdata();
      }
      while ( count($images) < 4 && !empty($fallbacks) ) $images[] = array_shift($fallbacks);
      if ( empty($images) ) $images[] = get_template_directory_uri() . '/assets/images/Rectangle 12.png';

      foreach ($images as $img) : ?>
        <article class="news-card-property">
          <div class="news-thumb-property" style="background-image:url('<?php echo esc_url($img); ?>');"></div>
        </article>
      <?php endforeach; ?>
  </div>
  <?php
}

function ng_render_homes_grid($cat){
  ?>
  <div class="lifestyle-grid">
    <?php
    $homes_query = new WP_Query( array(
      'posts_per_page' => 4,
      'category_name'  => $cat,
    ) );

    if ( $homes_query->have_posts() ) :
      while ( $homes_query->have_posts() ) : $homes_query->the_post();
        $img = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: get_template_directory_uri() . '/assets/images/cluster-placeholder.jpg';
        ?>
        <article class="home-card" style="background-image:url('<?php echo esc_url( $img ); ?>')">
          <a href="<?php the_permalink(); ?>" class="home-card-link">
            <div class="home-card-caption">
              <strong><?php the_title(); ?></strong>
              <span class="muted">Neat Homes to fit your family</span>
            </div>
          </a>
        </article>
        <?php
      endwhile;
      wp_reset_postdata();
    else:
      $fallback_homes = [
        [ 'img'=>'Group 9.png',  'title'=>'House Plan 1', 'desc'=>'This offers a fantastic experience for home seekers of all levels.' ],
        [ 'img'=>'Group 8.png',  'title'=>'House Plan 2', 'desc'=>'This modern and spacious design is perfect for growing families.' ],
        [ 'img'=>'Group 10.png', 'title'=>'House Plan 3', 'desc'=>'This design focuses on maximizing natural light and efficient use of space.' ],
        [ 'img'=>'Group 11.png', 'title'=>'House Plan 4', 'desc'=>'A unique layout combining style with convenience for the modern household.' ],
      ];
      foreach ($fallback_homes as $home) {
        $img = get_template_directory_uri() . '/assets/images/' . $home['img']; ?>
        <div>
          <article class="home-card" style="background-image:url('<?php echo esc_url( $img ); ?>')"></article>
          <div class="house-plan-cards">
            <p class="section-lead-news-heading"><?php echo esc_html( $home['title'] ); ?></p>
            <p class="section-lead"><?php echo esc_html( $home['desc'] ); ?></p>
            <div class="lifestyle-cta-wrap">
              <a class="btn-secondary" href="<?php echo esc_url( home_url( '#' ) ); ?>">See House</a>
            </div>
          </div>
        </div>
      <?php }
    endif; ?>
  </div>
  <?php
}
?>

<section class="house-layout-section">
  <div class="house-layout-inner container-fluid">

    <!-- RIGHT: layout details -->
    <div class="house-right">
      <h2 id="house-layout-title" class="section-heading">Select House Design</h2>

      <!-- SINGLE Plan picker -->
      <div class="plan-picker" data-current="0">
        <button class="plan-button"
                type="button"
                aria-haspopup="listbox"
                aria-expanded="false"
                aria-label="Select house plan">
          <span class="plan-button-label"><?php echo esc_html($plans[0]['title']); ?></span>
          <span class="plan-button-caret" aria-hidden="true">▾</span>
        </button>

        <ul class="plan-menu" role="listbox" tabindex="-1" aria-label="House plan options">
          <?php foreach ($plans as $i => $p): ?>
            <li class="plan-option"
                role="option"
                data-index="<?php echo esc_attr($i); ?>"
                aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>">
              <p class="plan-title"><?php echo esc_html($p['title']); ?></p>
              <img class="plan-thumb" src="<?php echo esc_url($p['thumb']); ?>" alt="" />
            </li>
            <?php if ($i < count($plans)-1): ?><li class="plan-divider" aria-hidden="true"></li><?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>

      <ul id="spec-list" class="layout-list" role="list">
        <?php foreach ( $plans[0]['items'] as $it ) : ?>
          <li class="layout-item">
            <span class="layout-label"><?php echo esc_html( $it['label'] ); ?></span>
            <span class="layout-value"><?php echo esc_html( $it['value'] ); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>

      <div class="layout-total">
        <span id="total-label" class="total-label"><?php echo esc_html( $plans[0]['total_label'] ); ?></span>
        <span id="total-value" class="total-value"><?php echo esc_html( $plans[0]['total_price'] ); ?></span>
      </div>
    </div>

    <!-- LEFT: photo-->
    <div class="house-left" aria-labelledby="house-layout-title">
      <div class="floor-frames">
        <!-- Plan drawing -->
        <!-- <div id="panel-photo" class="floor-panel is-visible" role="tabpanel">
          <div class="floor-image-photo">
            <img id="plan-photo" class="floor-image-1"
                 src="<?php echo esc_url( $plans[0]['photo_img'] ); ?>"
                 alt="<?php echo esc_attr( $plans[0]['title'] ); ?> photo" />
          </div>
        </div> -->

        <!-- Photo / nice image -->
        <div id="panel-drawing" class="floor-panel" role="tabpanel">
          <div class="floor-image-plan">
            <img id="plan-drawing" class="floor-image-1"
                 src="<?php echo esc_url( $plans[0]['plan_img'] ); ?>"
                 alt="<?php echo esc_attr( $plans[0]['title'] ); ?> plan" />
          </div>
        </div>

      </div>
    </div>

  </div>

  <?php
  //feature icons 
  $icon_house = get_stylesheet_directory_uri() . '/assets/images/Group 67.png';
  $icon_tree  = get_stylesheet_directory_uri() . '/assets/images/Group 68.png';
  $icon_bed   = get_stylesheet_directory_uri() . '/assets/images/Group 69.png';
  $icon_pool  = get_stylesheet_directory_uri() . '/assets/images/Group 70.png';
  ?>

  <?php foreach (['400','500-600','1000','cluster'] as $g): $gc = $group_content[$g] ?? null; if(!$gc) continue; ?>
 
  <div class="js-group-block" data-group="<?php echo esc_attr($g); ?>" <?php echo $g==='400' ? '' : 'hidden'; ?>>

    <!-- Image sections -->
    <!-- <section class="house-image-col mt-5 mb-5 container-fluid">
      <div class="house-image">
        <?php $house_img = $gc['stand_image'] ?: (get_template_directory_uri() . '/assets/images/Rectangle 22.png'); ?>
        <img src="<?php echo esc_url( $house_img ); ?>" alt="Residential pool and courtyard">
      </div>
    </section> -->


    

<section class="house-image-col mt-5 mb-5 container-fluid">
  <?php
    // Build a small list of images for the slider.
    // You can add/remove items in this array as needed.
    $house_images = [];

    // Main stand image from group content (existing logic)
    $main_image = $gc['stand_image'] ?: (get_template_directory_uri() . '/assets/images/Rectangle 22.png');
    $house_images[] = $main_image;

    // OPTIONAL: extra static images (remove these if you don’t need them)
    $house_images[] = get_template_directory_uri() . '/assets/images/plans/House-Type-3-165-sqm-Ground-88-sqm-First-77-sqm.jpg';
    $house_images[] = get_template_directory_uri() . '/assets/images/plans/House-type-2-130-sqm-photo.png';
  ?>

  <div id="houseImageCarousel-<?php echo esc_attr( $g ); ?>" class="carousel slide house-image" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php foreach ( $house_images as $i => $img_url ) : ?>
        <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
          <img src="<?php echo esc_url( $img_url ); ?>" class="d-block w-100" alt="">
        </div>
      <?php endforeach; ?>
    </div>

    <?php if ( count( $house_images ) > 1 ) : ?>
      <button class="carousel-control-prev" type="button"
              data-bs-target="#houseImageCarousel-<?php echo esc_attr( $g ); ?>"
              data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button"
              data-bs-target="#houseImageCarousel-<?php echo esc_attr( $g ); ?>"
              data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    <?php endif; ?>
  </div>
</section>

    <section class="stand-section" aria-labelledby="stand-heading-<?php echo esc_attr($g); ?>">
      <div class="stand-inner container-fluid">

        <div class="stand-left">
          <h2 id="stand-heading-<?php echo esc_attr($g); ?>" class="stand-title"><?php echo esc_html($gc['stand_title']); ?></h2>

          <p class="stand-intro">
            <?php echo esc_html($gc['stand_intro']); ?>
          </p>

          <ul class="stand-features" aria-label="Property features">
            <li class="feature"><img class="feature-icon" src="<?php echo esc_url( $icon_house ); ?>" alt="Property type icon" width="34" height="34" /></li>
            <li class="feature"><img class="feature-icon" src="<?php echo esc_url( $icon_tree ); ?>"  alt="Green spaces icon" width="34" height="34" /></li>
            <li class="feature"><img class="feature-icon" src="<?php echo esc_url( $icon_bed ); ?>"   alt="Accommodation icon" width="34" height="34" /></li>
            <li class="feature"><img class="feature-icon" src="<?php echo esc_url( $icon_pool ); ?>"  alt="Activity icon" width="34" height="34" /></li>
          </ul>

          <div class="stand-cta">
            <a class="btn-stand" href="#" role="button">BUY STAND</a>
          </div>
        </div>

        <div class="stand-right" aria-hidden="false">
          <div class="stand-image-frame">
            <img src="<?php echo esc_url( $gc['stand_image'] ); ?>" alt="<?php echo esc_attr($gc['stand_title']); ?> illustration" />
          </div>
        </div>

      </div>
    </section>

<!-- 3D Renders of the 400 sqm Stands -->

    <section class=" mt-5 container-fluid">
      <div class="news-section">
        <div class="news-header">
          <h2 class=" property-heading "><?php echo esc_html($gc['property_heading']); ?></h2>
          <div class="news-nav">
            <button class="news-prev" aria-label="Previous">&lsaquo;</button>
            <button class="news-next" aria-label="Next">&rsaquo;</button>
          </div>
        </div>

        <?php ng_render_renders_carousel($gc['renders_category']); ?>
      </div>
    </section>

    <section class="house-plan-section-main mb-5">
        <div class="container-fluid">
          <div class="lifestyle-header">
            <h2 class="section-heading"><?php echo wp_kses_post( $gc['other_plans_heading'] ); ?></h2>
          </div>

          <?php ng_render_homes_grid($gc['homes_category']); ?>

        </div> 
    </section>
  </div>
  <?php endforeach; ?>

</section>

<script>
(function(){
  const picker = document.querySelector('.plan-picker');
  if (!picker) return;

  const btn      = picker.querySelector('.plan-button');
  const labelEl  = picker.querySelector('.plan-button-label');
  const menu     = picker.querySelector('.plan-menu');
  const options  = menu ? [...menu.querySelectorAll('.plan-option')] : [];

  // Images + spec + totals (unchanged)
  const photoEl   = document.getElementById('plan-photo');
  const drawingEl = document.getElementById('plan-drawing');
  const specList   = document.getElementById('spec-list');
  const totalLabel = document.getElementById('total-label');
  const totalValue = document.getElementById('total-value');

  const plans = <?php echo wp_json_encode( $plans ); ?> || [];
  if (!plans.length || !btn || !menu) return;

  // --- helpers -------------------------------------------------------
  function slugify(s=''){
    return String(s)
      .toLowerCase()
      .normalize('NFKD')
      .replace(/[\u0300-\u036f]/g,'')     
      .replace(/[^a-z0-9]+/g,'-')       
      .replace(/^-+|-+$/g,'')             
  }

  function showGroup(groupKey){
    document.querySelectorAll('.js-group-block').forEach(el=>{
      el.hidden = (el.dataset.group !== groupKey);
    });
  }

  function renderSpecs(i){
    const p = plans[i]; if (!p) return;
    if (specList && Array.isArray(p.items)) {
      specList.innerHTML = p.items.map(item => `
        <li class="layout-item">
          <span class="layout-label">${item.label ?? ''}</span>
          <span class="layout-value">${item.value ?? ''}</span>
        </li>
      `).join('');
    }
    if (totalLabel) totalLabel.textContent = p.total_label || 'TOTAL';
    if (totalValue) totalValue.textContent = p.total_price || '';
  }

  function inferGroupFromTitle(title){
    const t = (title || '').toLowerCase();
    if (t.includes('500–600') || t.includes('500-600')) return '500-600';
    if (t.includes('1000')) return '1000';
    if (t.includes('cluster')) return 'cluster';
    return '400';
  }

  function selectIndex(i, {scrollIntoView=false} = {}){
    const p = plans[i]; if (!p) return;

    picker.dataset.current = String(i);
    if (labelEl) labelEl.textContent = p.title || 'Plan';

 
    if (photoEl   && p.photo_img)  { photoEl.src   = p.photo_img;  photoEl.alt   = (p.title || '') + ' photo'; }
    if (drawingEl && p.plan_img)   { drawingEl.src = p.plan_img;   drawingEl.alt = (p.title || '') + ' plan';  }

    renderSpecs(i);

    const groupKey = p.stand_group || inferGroupFromTitle(p.title);
    showGroup(groupKey);

    options.forEach(o => {
      o.setAttribute('aria-selected', (o.dataset.index == i ? 'true' : 'false'));
    });

    if (scrollIntoView) {

      const host = document.querySelector('.house-layout-section');
      if (host) host.scrollIntoView({behavior:'smooth', block:'start'});
    }
  }

  function openMenu(){ menu.classList.add('is-open'); btn.setAttribute('aria-expanded','true'); }
  function closeMenu(){ menu.classList.remove('is-open'); btn.setAttribute('aria-expanded','false'); }

  btn.addEventListener('click', () => {
    menu.classList.contains('is-open') ? closeMenu() : openMenu();
  });

  options.forEach(o => {
    o.addEventListener('click', () => { selectIndex(+o.dataset.index); closeMenu(); });
  });

  document.addEventListener('click', (e) => { if (!picker.contains(e.target)) closeMenu(); });

  // --- Deep-linking --------------------------------------------------
  function getParams(){
    const q = new URLSearchParams(window.location.search);
    const hash = new URLSearchParams((window.location.hash || '').replace(/^#/, ''));
   
    return {
      group: (q.get('group') || hash.get('group') || '').toLowerCase(),
      plan:  (q.get('plan')  || hash.get('plan')  || ''),
      index: q.has('index') ? parseInt(q.get('index'),10) :
             (hash.has('index') ? parseInt(hash.get('index'),10) : null),
      type:  (q.get('type')  || hash.get('type')  || '').toLowerCase(),
    };
  }

  function findInitialIndex(){
    const { group, plan, index, type } = getParams();

    // 1) explicit numeric index
    if (Number.isInteger(index) && index >= 0 && index < plans.length) {
      return index;
    }

    // 2) match by plan slug in title
    if (plan) {
      const wanted = plan.toLowerCase();
      const i = plans.findIndex(p => slugify(p.title) === wanted);
      if (i !== -1) return i;
    }

    // 3) match by type (useful for 6a/6b)
    if (type) {
      // normalize: "6a" or "type-6a"
      const t = type.replace(/^type-/, '');
      const i = plans.findIndex(p => slugify(p.title).includes('-' + t));
      if (i !== -1) return i;
    }

    // 4) match by group (first plan in that group)
    if (group) {
      const i = plans.findIndex(p => (p.stand_group || '').toLowerCase() === group);
      if (i !== -1) return i;
    }

    // default
    return + (picker.dataset.current ?? 0);
  }

  // Initial (deep-link aware)
  const initial = findInitialIndex();
  selectIndex(initial, {scrollIntoView: !!window.location.search || !!window.location.hash});
})();


(function(){
  // Bind carousel controls per visible news section (works even when switching groups)
  document.querySelectorAll('.news-section').forEach(section=>{
    const carousel = section.querySelector('.news-carousel');
    const prev = section.querySelector('.news-prev');
    const next = section.querySelector('.news-next');
    if(!carousel || !prev || !next) return;

    function step(){
      const card = carousel.querySelector('.news-card-property');
      if(!card) return carousel.clientWidth;
      const styles = getComputedStyle(carousel);
      const gap = parseFloat(styles.columnGap || styles.gap || 16);
      return card.getBoundingClientRect().width + gap;
    }

    function updateButtons(){
      const max = carousel.scrollWidth - carousel.clientWidth - 1;
      prev.disabled = carousel.scrollLeft <= 0;
      next.disabled = carousel.scrollLeft >= max;
    }

    prev.addEventListener('click', () => {
      carousel.scrollBy({ left: -step(), behavior: 'smooth' });
    });
    next.addEventListener('click', () => {
      carousel.scrollBy({ left:  step(), behavior: 'smooth' });
    });

    carousel.addEventListener('scroll', updateButtons);
    window.addEventListener('resize', updateButtons, { passive: true });
    updateButtons();
  });
})();
</script>

<?php get_footer(); ?>
