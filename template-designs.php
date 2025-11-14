<?php
  /* Template Name: Designs */
  get_header();
?>

<?php  get_template_part( 'banners/allpage-banner' );?>

<section class="house-layout-section">

  <?php
    $args = array(
        'post_type'      => 'designs',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    );

    $design_query = new WP_Query($args);
  ?>

  <?php if ( $design_query->have_posts() ) : ?>
    <?php while ( $design_query->have_posts() ) : $design_query->the_post(); ?>

  <div class="house-layout-inner container-fluid">
    
    <div class="house-right">
      <h2 id="house-layout-title" class="section-heading"><?php the_title(); ?></h2>

      <p>View other House Designs</p>
      <!-- SINGLE Plan picker -->
      <div class="plan-picker" data-current="0">
        <button class="plan-button"
                type="button"
                aria-haspopup="listbox"
                aria-expanded="false"
                aria-label="Select house plan">
          <span class="plan-button-label">Choose Designer</span>
          <span class="plan-button-caret" aria-hidden="true">▾</span>
        </button>

        <ul class="plan-menu" role="listbox" tabindex="-1" aria-label="House plan options">
            <li class="plan-option"
                role="option"
                data-index=""
                aria-selected="#">
              <p class="plan-title">Name of Designer</p>
              <img class="plan-thumb" src="#" alt="Design Image" />
            </li>
            <li class="plan-divider" aria-hidden="true"></li>           
        </ul>
      </div>
      

      <ul id="spec-list" class="layout-list" role="list">
        <?php
          $details = carbon_get_post_meta(get_the_ID(), 'design_floor_plan_details');

          if (!empty($details)) :
              foreach ($details as $detail) :
          ?>

          <li class="layout-item">
            <span class="layout-label"><?php echo esc_html($detail['design_space']); ?></span>
            <span class="layout-value"><?php echo esc_html($detail['design_sqm']); ?> Sqm</span>
          </li>

          <?php endforeach; else : ?>
              <p>No plan details available.</p>
          <?php endif; ?>
      </ul>

      <div class="layout-total">
        <span id="total-label" class="total-label">Total Price</span>
        <span id="total-value" class="total-value">usd$ <?php echo carbon_get_post_meta(get_the_ID(), 'design_price'); ?></span>
      </div>
    </div>
    
    <div class="house-left" aria-labelledby="house-layout-title">
      <div class="floor-frames">

      <?php 
        $floor_plan = carbon_get_post_meta(get_the_ID(), 'design_floor_plan'); 
        if ( $floor_plan ): 
      ?>
      <!-- Floor Plan Image -->
      <div id="panel-drawing" class="floor-panel" role="tabpanel">
        <div class="floor-image-plan">
          <img id="plan-drawing" class="floor-image-1" src="<?php echo esc_url($floor_plan); ?>" alt="Floor Plan" />
        </div>
      </div>
      <?php endif; ?>

      </div>
    </div>

  </div>

  <section class="house-image-col mt-5 mb-5 container-fluid">
    <div id="houseImageCarousel" class="carousel slide house-image" data-bs-ride="carousel">
      <div class="carousel-inner">

          <?php
          $slides = carbon_get_post_meta(get_the_ID(), 'design_slider');

          if (!empty($slides)) :
              foreach ($slides as $slide) :
                  if (!empty($slide['design_images'])) :
          ?>
          

                  

                  <div class="carousel-item <?php echo $slide === 0 ? 'active' : ''; ?>">
          <img src="<?php echo esc_url($slide['design_images']); ?>" alt="Design Slide">
        </div>


          <?php 
                  endif;
              endforeach;
          else :
          ?>
              <p>No slider images.</p>
          <?php endif; ?>
      </div>
      
      <button class="carousel-control-prev" type="button"
              data-bs-target="#houseImageCarousel"
              data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button"
              data-bs-target="#houseImageCarousel"
              data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

    <?php else : ?>
      <p>No designs found.</p>
  <?php endif; ?>


  

  <section class="stand-section">
    <div class="stand-inner container-fluid">

      <div class="stand-left">
        <h2 class="stand-title">
          <?php echo carbon_get_post_meta( get_the_ID(), 'banner_headline' ); ?>
        </h2>

        <p class="stand-intro">
          <?php the_content( );?>
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
          <?php the_post_thumbnail();?>
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
          $homes_query = new WP_Query( array(
            'posts_per_page' => 4,
            'category_name'  => 'homes',
            'post_status'    => 'publish',
            'ignore_sticky_posts' => true,
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
            $fallback = array(
              'Group 11.png',
              'Group 10.png',
              'Group 9.png',
              'Group 8.png',
            );
          $fallback = array('Group 11.png','Group 10.png','Group 9.png','Group 8.png');
          $titles   = array('400 sqm Stands','500-600 sqm Stands','1000sqm Stands','Cluster Housing');

          foreach ( $fallback as $i => $file ) {
          $img   = get_template_directory_uri() . '/assets/images/' . $file;
          $title = $titles[$i] ?? 'Homes';
        ?>

        <article class="home-card" style="background-image:url('<?php echo esc_url( $img ); ?>')">
          <div class="home-card-caption">
            <p class="home-card-caption-text"><?php echo esc_html( $title ); ?></p>
            <p class="muted">Neat Homes to fit your family</p>
          </div>
        </article>
        <?php
            }
        endif;
        ?>
      </div>
    </div>
  </section>

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
