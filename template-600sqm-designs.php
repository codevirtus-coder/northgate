<?php
  /* Template Name: Designs - 600 Sqm */
  get_header();
?>

<?php get_template_part('banners/allpage-banner'); ?>

<section class="house-layout-section">

  <?php
    // This allows users to navigate to different sizes via URL
    $selected_size = isset($_GET['size']) ? sanitize_text_field($_GET['size']) : '600 Sqm';

    $args = array(
      'post_type'      => 'designs',
      'posts_per_page' => -1,
      'post_status'    => 'publish',
      'orderby'        => 'menu_order',
      'order'          => 'ASC'
    );

    // Add meta_query only if we have a selected size
    if (!empty($selected_size)) {
      $args['meta_query'] = array(
        array(
          'key'     => 'design_sizes',
          'value'   => $selected_size,
          'compare' => '='
        )
      );
    }

    $design_query = new WP_Query($args);

    // Collect all designs for the dropdown
    $plans = array();
    if ($design_query->have_posts()) {
      while ($design_query->have_posts()) {
        $design_query->the_post();
        
        $floor_plan_details = carbon_get_post_meta(get_the_ID(), 'design_floor_plan_details');
        $items = array();
        if (!empty($floor_plan_details)) {
          foreach ($floor_plan_details as $detail) {
            $items[] = array(
              'label' => $detail['design_space'],
              'value' => $detail['design_sqm'] . ' Sqm'
            );
          }
        }

        // Get slider images
        $slider_images = carbon_get_post_meta(get_the_ID(), 'design_slider');
        
        // Get first slider image as thumbnail
        $thumbnail_img = '';
        if (!empty($slider_images) && !empty($slider_images[0]['design_images'])) {
          $thumbnail_img = $slider_images[0]['design_images'];
        } elseif (has_post_thumbnail()) {
          $thumbnail_img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        }

        $plans[] = array(
          'id'          => get_the_ID(),
          'title'       => get_the_title(),
          'photo_img'   => $thumbnail_img,
          'plan_img'    => carbon_get_post_meta(get_the_ID(), 'design_floor_plan'),
          'items'       => $items,
          'total_label' => 'Total Price',
          'total_price' => 'USD ' . carbon_get_post_meta(get_the_ID(), 'design_price'),
          'stand_group' => carbon_get_post_meta(get_the_ID(), 'design_sizes'),
          'slider'      => $slider_images
        );
      }
      wp_reset_postdata();
    }
  ?>

  <?php if (!empty($plans)) : ?>
    <?php $first_plan = $plans[0]; ?>

  <div class="house-layout-inner container-fluid">
    
    <div class="house-right">
      <h2 id="house-layout-title" class="section-heading"><?php echo esc_html($first_plan['title']); ?></h2>

      <p>View other House Designs</p>
      <!-- Plan Picker -->
      <div class="plan-picker" data-current="0">
        <button class="plan-button"
                type="button"
                aria-haspopup="listbox"
                aria-expanded="false"
                aria-label="Select house plan">
          <span class="plan-button-label"><?php echo esc_html($first_plan['title']); ?></span>
          <span class="plan-button-caret" aria-hidden="true">▾</span>
        </button>

        <ul class="plan-menu" role="listbox" tabindex="-1" aria-label="House plan options">
          <?php foreach ($plans as $index => $plan) : ?>
            <li class="plan-option"
                role="option"
                data-index="<?php echo esc_attr($index); ?>"
                aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
              <p class="plan-title"><?php echo esc_html($plan['title']); ?></p>
              <?php if ($plan['photo_img']) : ?>
                <img class="plan-thumb" src="<?php echo esc_url($plan['photo_img']); ?>" alt="<?php echo esc_attr($plan['title']); ?>" />
              <?php endif; ?>
            </li>
            <?php if ($index < count($plans) - 1) : ?>
              <li class="plan-divider" aria-hidden="true"></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
      
      <ul id="spec-list" class="layout-list" role="list">
        <?php if (!empty($first_plan['items'])) : ?>
          <?php foreach ($first_plan['items'] as $item) : ?>
            <li class="layout-item">
              <span class="layout-label"><?php echo esc_html($item['label']); ?></span>
              <span class="layout-value"><?php echo esc_html($item['value']); ?></span>
            </li>
          <?php endforeach; ?>
        <?php else : ?>
          <p>No plan details available.</p>
        <?php endif; ?>
      </ul>

      <div class="layout-total">
        <span id="total-label" class="total-label">Total Price</span>
        <span id="total-value" class="total-value"><?php echo esc_html($first_plan['total_price']); ?></span>
      </div>
    </div>
    
    <div class="house-left" aria-labelledby="house-layout-title">
      <div class="floor-frames">
        <?php if ($first_plan['plan_img']) : ?>
          <div id="panel-drawing" class="floor-panel" role="tabpanel">
            <div class="floor-image-plan">
              <img id="plan-drawing" class="floor-image-1" src="<?php echo esc_url($first_plan['plan_img']); ?>" alt="Floor Plan" />
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <section class="house-image-col mt-5 mb-5 container-fluid">
    <div id="houseImageCarousel" class="house-image-carousel">
      <div class="carousel-inner">
        <?php 
        $slides = $first_plan['slider'];
        if (!empty($slides)) : 
          foreach ($slides as $slide_index => $slide) :
            if (!empty($slide['design_images'])) :
        ?>       
              <div class="carousel-item <?php echo $slide_index === 0 ? 'active' : ''; ?>">
                <img src="<?php echo esc_url($slide['design_images']); ?>" class="d-block w-100" alt="Design Slide <?php echo $slide_index + 1; ?>">
              </div>
        <?php 
            endif;
          endforeach;
        else :
        ?>
          <div class="carousel-item active">
            <p>No slider images.</p>
          </div>
        <?php endif; ?>
      </div>
      
      <?php if (!empty($slides) && count($slides) > 1) : ?>
        <button class="carousel-control carousel-control-prev" type="button" aria-label="Previous slide">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control carousel-control-next" type="button" aria-label="Next slide">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>

        <div class="carousel-indicators">
          <?php foreach ($slides as $indicator_index => $slide) : ?>
            <?php if (!empty($slide['design_images'])) : ?>
              <button type="button" 
                      data-slide-to="<?php echo $indicator_index; ?>"
                      class="<?php echo $indicator_index === 0 ? 'active' : ''; ?>"
                      aria-label="Slide <?php echo $indicator_index + 1; ?>"></button>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <?php else : ?>
    <h2>No designs found.</h2>
  <?php endif; ?>

  <section class="stand-section">
    <div class="stand-inner container-fluid">
      <div class="stand-left">
        <h2 class="stand-title">
          <?php the_title(); ?>
        </h2>

        <p class="stand-intro">
          <?php the_content(); ?>
        </p>

        <?php
           $theme_uri = get_template_directory_uri();
      ?>
       
      <ul class="stand-features" aria-label="Property features">
       <li class="feature">
       <img
      class="feature-icon"
      src="<?php echo esc_url( ! empty( $icon_house ) ? $icon_house : $theme_uri . '/assets/images/featured-icons-stands/property.png' ); ?>"
      alt="Property type icon"
      width="34"
      height="34"
    />
  </li>

  <li class="feature">
    <img
      class="feature-icon"
      src="<?php echo esc_url( ! empty( $icon_tree ) ? $icon_tree : $theme_uri . '/assets/images/featured-icons-stands/green-spaces.png' ); ?>"
      alt="Green spaces icon"
      width="34"
      height="34"
    />
  </li>

  <li class="feature">
    <img
      class="feature-icon"
      src="<?php echo esc_url( ! empty( $icon_bed ) ? $icon_bed : $theme_uri . '/assets/images/featured-icons-stands/accomodation.png' ); ?>"
      alt="Accommodation icon"
      width="34"
      height="34"
    />
  </li>

  <li class="feature">
    <img
      class="feature-icon"
      src="<?php echo esc_url( ! empty( $icon_pool ) ? $icon_pool : $theme_uri . '/assets/images/featured-icons-stands/activity.png' ); ?>"
      alt="Activity icon"
      width="34"
      height="34"
    />
  </li>
</ul>

        <div class="stand-cta">
          <a class="btn-stand" href="https://portal.northgateestates.co.zw/" role="button" target="_blank" rel="noopener noreferrer">BUY STAND</a>
        </div>
      </div>

      <div class="stand-right" aria-hidden="false">
        <div class="stand-image-frame">
          <?php the_post_thumbnail(); ?>
        </div>
      </div>
    </div>
  </section>

 <section class="house-plan-section-main mb-5"> 
  <div class="container-fluid">
    <div class="lifestyle-header">
      <h2 class="section-heading">View Other Residency</h2>
    </div>
    
    <div class="lifestyle-grid">
      <?php
        // Map design_sizes -> stand page URLs (same idea as header)
        $size_links = array(
          '400 Sqm'            => '/400-sqm-stands',
          '600 Sqm'            => '/600-sqm-stands',
          '1200 Sqm'           => '/1200-sqm-stands',
          'Cluster/Apartments' => '/cluster-apartments',
        );

        // Query all designs to build stand cards
        $stands_query = new WP_Query(array(
          'post_type'      => 'designs',
          'posts_per_page' => -1,
          'post_status'    => 'publish',
          'orderby'        => 'menu_order',
          'order'          => 'ASC',
        ));

        // One card per unique size
        $stand_cards = array();

        if ( $stands_query->have_posts() ) {
          while ( $stands_query->have_posts() ) {
            $stands_query->the_post();

            $size = carbon_get_post_meta( get_the_ID(), 'design_sizes' );
            if ( ! $size ) {
              continue;
            }

            // Don't show the current stand size
            if ( isset( $selected_size ) && $size === $selected_size ) {
              continue;
            }

            // Already added a card for this size? Skip to keep it simple
            if ( isset( $stand_cards[ $size ] ) ) {
              continue;
            }

            // Build target URL
            if ( isset( $size_links[ $size ] ) ) {
              $url = home_url( $size_links[ $size ] );
            } else {
              $url = get_permalink();
            }

            // Thumbnail: first slider image > featured image > fallback
            $slider_images = carbon_get_post_meta( get_the_ID(), 'design_slider' );
            if ( ! empty( $slider_images ) && ! empty( $slider_images[0]['design_images'] ) ) {
              $img = $slider_images[0]['design_images'];
            } elseif ( has_post_thumbnail() ) {
              $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
            } else {
              $img = get_template_directory_uri() . '/assets/images/stands/stand-placeholder.png';
            }

            $stand_cards[ $size ] = array(
              'title' => $size . ' Stands',
              'url'   => $url,
              'img'   => $img,
            );
          }
          wp_reset_postdata();
        }

        // Apply custom order
        if ( ! empty( $stand_cards ) ) :

          $size_order = array(
            '400 Sqm',
            '600 Sqm',
            '1200 Sqm',
            'Cluster/Apartments',
          );

          $ordered_cards = array();

          // 1. Add known sizes in this specific order (only if they exist & not current)
          foreach ( $size_order as $label ) {
            if ( isset( $stand_cards[ $label ] ) ) {
              $ordered_cards[] = $stand_cards[ $label ];
              unset( $stand_cards[ $label ] ); // avoid duplicates
            }
          }

          // 2. Append any leftovers (unexpected sizes)
          foreach ( $stand_cards as $card ) {
            $ordered_cards[] = $card;
          }

          // 3. Output in ordered list
          foreach ( $ordered_cards as $card ) :
      ?>
            <article class="home-card" style="background-image:url('<?php echo esc_url( $card['img'] ); ?>')">
              <!-- full-card clickable overlay -->
              <a
                href="<?php echo esc_url( $card['url'] ); ?>"
                class="home-card-link"
                aria-label="<?php echo esc_attr( $card['title'] ); ?>">
              </a>

              <!-- caption overlay -->
              <div class="home-card-caption">
                <strong><?php echo esc_html( $card['title'] ); ?></strong>
                <span class="muted">Neat Homes to fit your family</span>
              </div>
            </article>

      <?php
          endforeach;
        else :
          // Optional: simple fallback if there are no designs
          ?>
          <p>No other stands found.</p>
        <?php endif; ?>
    </div>
  </div>
</section>



</section> 

<script>
(function(){
  'use strict';

  // ============================================================
  // PLAN PICKER
  // ============================================================
  const picker = document.querySelector('.plan-picker');
  if (!picker) return;

  const btn = picker.querySelector('.plan-button');
  const labelEl = picker.querySelector('.plan-button-label');
  const menu = picker.querySelector('.plan-menu');
  const options = menu ? [...menu.querySelectorAll('.plan-option')] : [];
  const drawingEl = document.getElementById('plan-drawing');
  const specList = document.getElementById('spec-list');
  const totalLabel = document.getElementById('total-label');
  const totalValue = document.getElementById('total-value');

  const plans = <?php echo wp_json_encode($plans); ?> || [];
  if (!plans.length || !btn || !menu) return;

  let currentCarousel = null;

  // ============================================================
  // CAROUSEL CLASS
  // ============================================================
  class DesignCarousel {
    constructor(container, slides) {
      this.container = container;
      this.slides = slides;
      this.currentIndex = 0;
      this.autoplayInterval = null;
      this.autoplayDelay = 5000;
      
      this.items = container.querySelectorAll('.carousel-item');
      this.prevBtn = container.querySelector('.carousel-control-prev');
      this.nextBtn = container.querySelector('.carousel-control-next');
      this.indicators = [...container.querySelectorAll('.carousel-indicators button')];
      
      this.init();
    }

    init() {
      if (!this.items.length) return;

      // Navigation buttons
      if (this.prevBtn) {
        this.prevBtn.addEventListener('click', () => {
          this.stopAutoplay();
          this.prev();
          this.startAutoplay();
        });
      }

      if (this.nextBtn) {
        this.nextBtn.addEventListener('click', () => {
          this.stopAutoplay();
          this.next();
          this.startAutoplay();
        });
      }

      // Indicator buttons
      this.indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
          this.stopAutoplay();
          this.goTo(index);
          this.startAutoplay();
        });
      });

      // Pause on hover
      this.container.addEventListener('mouseenter', () => this.stopAutoplay());
      this.container.addEventListener('mouseleave', () => this.startAutoplay());

      // Keyboard navigation
      this.container.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
          this.stopAutoplay();
          this.prev();
          this.startAutoplay();
        } else if (e.key === 'ArrowRight') {
          this.stopAutoplay();
          this.next();
          this.startAutoplay();
        }
      });

      this.startAutoplay();
    }

    goTo(index) {
      if (index < 0 || index >= this.items.length) return;

      // Update items
      this.items[this.currentIndex]?.classList.remove('active');
      this.items[index]?.classList.add('active');

      // Update indicators
      this.indicators[this.currentIndex]?.classList.remove('active');
      this.indicators[index]?.classList.add('active');

      this.currentIndex = index;
    }

    next() {
      const nextIndex = (this.currentIndex + 1) % this.items.length;
      this.goTo(nextIndex);
    }

    prev() {
      const prevIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
      this.goTo(prevIndex);
    }

    startAutoplay() {
      if (this.items.length <= 1) return;
      this.stopAutoplay();
      this.autoplayInterval = setInterval(() => this.next(), this.autoplayDelay);
    }

    stopAutoplay() {
      if (this.autoplayInterval) {
        clearInterval(this.autoplayInterval);
        this.autoplayInterval = null;
      }
    }

    destroy() {
      this.stopAutoplay();
    }

    rebuild(slides) {
      this.destroy();
      this.slides = slides;
      this.items = this.container.querySelectorAll('.carousel-item');
      this.indicators = [...this.container.querySelectorAll('.carousel-indicators button')];
      this.currentIndex = 0;
      this.init();
    }
  }

  // ============================================================
  // HELPER FUNCTIONS
  // ============================================================
  function renderSpecs(plan) {
    if (!specList || !plan) return;
    
    if (Array.isArray(plan.items) && plan.items.length) {
      specList.innerHTML = plan.items.map(item => `
        <li class="layout-item">
          <span class="layout-label">${item.label ?? ''}</span>
          <span class="layout-value">${item.value ?? ''}</span>
        </li>
      `).join('');
    } else {
      specList.innerHTML = '<p>No plan details available.</p>';
    }

    if (totalLabel) totalLabel.textContent = plan.total_label || 'Total Price';
    if (totalValue) totalValue.textContent = plan.total_price || '';
  }

  function renderCarousel(plan) {
    const carouselContainer = document.getElementById('houseImageCarousel');
    if (!carouselContainer || !plan) return;

    const hasMultipleSlides = Array.isArray(plan.slider) && plan.slider.length > 1;

    // Render carousel HTML
    const carouselHTML = `
      <div class="carousel-inner">
        ${Array.isArray(plan.slider) && plan.slider.length 
          ? plan.slider.map((slide, idx) => `
              <div class="carousel-item ${idx === 0 ? 'active' : ''}">
                <img src="${slide.design_images || ''}" class="d-block w-100" alt="Design Slide ${idx + 1}">
              </div>
            `).join('')
          : '<div class="carousel-item active"><p>No slider images.</p></div>'
        }
      </div>
      ${hasMultipleSlides ? `
        <button class="carousel-control carousel-control-prev" type="button" aria-label="Previous slide">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control carousel-control-next" type="button" aria-label="Next slide">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        <div class="carousel-indicators">
          ${plan.slider.map((slide, idx) => `
            <button type="button" 
                    data-slide-to="${idx}"
                    class="${idx === 0 ? 'active' : ''}"
                    aria-label="Slide ${idx + 1}"></button>
          `).join('')}
        </div>
      ` : ''}
    `;

    carouselContainer.innerHTML = carouselHTML;

    // Initialize new carousel
    if (currentCarousel) {
      currentCarousel.destroy();
    }
    if (hasMultipleSlides) {
      currentCarousel = new DesignCarousel(carouselContainer, plan.slider);
    }
  }

  function selectPlan(index) {
    const plan = plans[index];
    if (!plan) return;

    picker.dataset.current = String(index);
    if (labelEl) labelEl.textContent = plan.title || 'Plan';

    const titleEl = document.getElementById('house-layout-title');
    if (titleEl) {
      titleEl.textContent = plan.title || '';
    }

    if (drawingEl && plan.plan_img) {
      drawingEl.src = plan.plan_img;
      drawingEl.alt = (plan.title || '') + ' plan';
    }

    renderSpecs(plan);
    renderCarousel(plan);

    // Update option states
    options.forEach(o => {
      o.setAttribute('aria-selected', (o.dataset.index == index ? 'true' : 'false'));
    });
  }

  // ============================================================
  // MENU INTERACTIONS
  // ============================================================
  function openMenu() {
    menu.classList.add('is-open');
    btn.setAttribute('aria-expanded', 'true');
  }

  function closeMenu() {
    menu.classList.remove('is-open');
    btn.setAttribute('aria-expanded', 'false');
  }

  btn.addEventListener('click', () => {
    menu.classList.contains('is-open') ? closeMenu() : openMenu();
  });

  options.forEach(o => {
    o.addEventListener('click', () => {
      selectPlan(+o.dataset.index);
      closeMenu();
    });
  });

  document.addEventListener('click', (e) => {
    if (!picker.contains(e.target)) closeMenu();
  });

  // ============================================================
  // DEEP LINKING
  // ============================================================
  function slugify(s = '') {
    return String(s)
      .toLowerCase()
      .normalize('NFKD')
      .replace(/[\u0300-\u036f]/g, '')
      .replace(/[^a-z0-9]+/g, '-')
      .replace(/^-+|-+$/g, '');
  }

  function getParams() {
    const q = new URLSearchParams(window.location.search);
    const hash = new URLSearchParams((window.location.hash || '').replace(/^#/, ''));

    return {
      plan: (q.get('plan') || hash.get('plan') || ''),
      index: q.has('index') ? parseInt(q.get('index'), 10) :
        (hash.has('index') ? parseInt(hash.get('index'), 10) : null)
    };
  }

  function findInitialIndex() {
    const { plan, index } = getParams();

    if (Number.isInteger(index) && index >= 0 && index < plans.length) {
      return index;
    }

    if (plan) {
      const wanted = plan.toLowerCase();
      const i = plans.findIndex(p => slugify(p.title) === wanted);
      if (i !== -1) return i;
    }

    return +(picker.dataset.current ?? 0);
  }

  // Initialize
  const initialIndex = findInitialIndex();
  selectPlan(initialIndex);

  // Initialize first carousel
  const firstCarouselContainer = document.getElementById('houseImageCarousel');
  if (firstCarouselContainer && plans[initialIndex]?.slider?.length > 1) {
    currentCarousel = new DesignCarousel(firstCarouselContainer, plans[initialIndex].slider);
  }
})();
</script>

<?php get_footer(); ?>