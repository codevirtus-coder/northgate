<?php

get_header();
get_template_part('banners/allpage-banner');

/* ---------- SETTINGS ---------- */
$target_url = home_url('/residential');




$groups = [
  '400' => [
    'title' => '400 sqm Stands',
    'intro' => 'Affordable, modern entry-level homes with neat, efficient layouts and smart use of space.',
    'image' => get_stylesheet_directory_uri() . '/assets/images/stand-images/500-600-sqm.jpg',
  ],
  '500-600' => [
    'title' => '500–600 sqm Stands',
    'intro' => 'Slightly larger homes with more generous living areas and outdoor space for entertaining.',
    'image' => get_stylesheet_directory_uri() . '/assets/images/stand-images/400-500-600-sqm.jpg',
  ],
  '1000' => [
    'title' => '1000 sqm Stands',
    'intro' => 'Spacious plots ideal for premium homes, private gardens, and statement outdoor amenities.',
    'image' => get_stylesheet_directory_uri() . '/assets/images/stand-images/1000-sqm.jpg',
  ],
  'cluster' => [
    'title' => 'Cluster Housing & Courtyard Apartments',
    'intro' => 'Courtyard-focused homes and apartments designed for community living and privacy.',
    'image' => get_stylesheet_directory_uri() . '/assets/images/stand-images/home_slider.jpg',
  ],
];


$phase_overrides = [
  'phase-1' => [
    '400'     => ['title'=>'400 sqm Stands', 'intro'=>'The largest proportion of the residential component within Northgate Estate, is 400sqm stands, which provide the prefect opportunity for first time / entry-level homes'],
    '500-600' => ['title'=>'500-600 sqm Stands', 'intro'=>'The residential component within Northgate Estate, also includes 500-600sqm stands, which are slightly larger than the 400sqm entry-level homes, with increases being mainly in terms of the sizes of the rooms.'],
    '1000'    => ['title'=>'1200 sqm Stands', 'intro'=>'The residential component within Northgate Estate, also includes a few larger stands of 1200sqm size. These stands provide the opportunity to build larger homes, while still having generous garden spaces, and perhaps more privacy where that may be a requirement.'],
    'cluster' => ['title'=>'Cluster Housing & Courtyard Apartments', 'intro'=>'Our idea is to create variety, dependent on the different stand allocation, some typical townhouse / cluster homes configured around courtyards whilst others reminiscent of classical courtyard apartment buildings.'],
  ],
  'phase-2' => [
    '400'     => ['title'=>'400 sqm — Phase 2', 'intro'=>'More storage, improved bathrooms, brighter living spaces.'],
    '500-600' => ['title'=>'500–600 sqm — Phase 2', 'intro'=>'Scullery + covered patio upgrades for effortless indoor-outdoor.'],
    '1000'    => ['title'=>'1000 sqm — Phase 2', 'intro'=>'Double-volume lounges/lofts and expanded garage storage.'],
    'cluster' => ['title'=>'Cluster & Courtyard — P2', 'intro'=>'Garden-level terraces and shaded braai pergolas added.'],
  ],
  'phase-3' => [
    '400'     => ['title'=>'400 sqm — Phase 3 Final', 'intro'=>'Mature streetscapes, tree-lined sidewalks, premium façade palette.'],
    '500-600' => ['title'=>'500–600 sqm — Phase 3', 'intro'=>'Largest kitchens, extended patios, optional pool-ready grading.'],
    '1000'    => ['title'=>'1000 sqm — Phase 3', 'intro'=>'Estate-scale backyards, privacy hedges, premium hardscape.'],
    'cluster' => ['title'=>'Cluster & Courtyard — P3', 'intro'=>'Car-light lanes, upgraded planting, calm shared spaces.'],
  ],
];


$phases = [
  ['key' => 'phase-1', 'label' => 'Phase 1'],
  ['key' => 'phase-2', 'label' => 'Phase 2'],
  ['key' => 'phase-3', 'label' => 'Phase 3'],
];
?>

<div class="container-fluid mt-2">
  <?php the_content();?>
</div>

<!-- <section class="container-fluid">
     <div class="news-header">
      <div class="plan-picker mt-5" id="phasePicker" data-current="0" style="min-width:220px;">
        <h2 class="house-layout-title">SELECT PHASE</h2>
        <button class="plan-button" type="button" aria-haspopup="listbox" aria-expanded="false" aria-label="Select phase">
          <span class="plan-button-label">Phase 1</span>
          <span class="plan-button-caret" aria-hidden="true">▾</span>
        </button>
        <ul class="plan-menu" role="listbox" tabindex="-1" aria-label="Phase options">
          <?php foreach ($phases as $i => $ph): ?>
            <li class="plan-option" role="option"
                data-index="<?php echo esc_attr($i); ?>"
                data-phase="<?php echo esc_attr($ph['key']); ?>"
                aria-selected="<?php echo $i===0 ? 'true' : 'false'; ?>">
              <p class="plan-title"><?php echo esc_html($ph['label']); ?></p>
            </li>
            <?php if ($i < count($phases)-1): ?><li class="plan-divider" aria-hidden="true"></li><?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>

      <div id="phaseNotice" class="section-lead muted" style="margin-top:.5rem; display:none;"></div>
    </div>


    <div class="news-carousel" id="standsGrid">
      <?php foreach ($groups as $key => $g): ?>
        <?php $img = $g['image']; $excerpt = $g['intro']; ?>
        <article class="news-card" data-group="<?php echo esc_attr($key); ?>">
          <a href="#" class="js-stand-link" data-group="<?php echo esc_attr($key); ?>">
            <div class="news-thumb js-stand-image"
                 style="background-image:url('<?php echo esc_url($img); ?>')"
                 data-default-image="<?php echo esc_url($img); ?>"></div>

            <div class="news-body">
              <h3 class="section-lead-news-heading js-stand-title"><?php echo esc_html($g['title']); ?></h3>
              <p class="section-lead muted js-stand-intro"><?php echo esc_html($excerpt); ?></p>
              <p class="btn-secondary">VIEW PLANS</p>
            </div>
          </a>
        </article>
      <?php endforeach; ?>
    </div>

</section> -->

<style>

  #standsGrid {
    overflow-x: visible !important;
    flex-wrap: wrap !important; 
  }
</style>

<script>
(function(){

  const groups    = <?php echo wp_json_encode($groups); ?>;
  const overrides = <?php echo wp_json_encode($phase_overrides); ?>;
  const phases    = [
    {key:'phase-1', label:'Phase 1'},
    {key:'phase-2', label:'Phase 2'},
    {key:'phase-3', label:'Phase 3'},
  ];
  const targetBase = '<?php echo esc_url($target_url); ?>';

  const grid = document.getElementById('standsGrid');
  const phase1HTML = grid ? grid.innerHTML : '';


  const picker  = document.getElementById('phasePicker');
  const btn     = picker?.querySelector('.plan-button');
  const labelEl = picker?.querySelector('.plan-button-label');
  const menu    = picker?.querySelector('.plan-menu');
  const options = menu ? [...menu.querySelectorAll('.plan-option')] : [];
  const notice  = document.getElementById('phaseNotice');

  function openMenu(){ menu.classList.add('is-open'); btn.setAttribute('aria-expanded','true'); }
  function closeMenu(){ menu.classList.remove('is-open'); btn.setAttribute('aria-expanded','false'); }

  function normPhase(p){
    const s = String(p||'').toLowerCase();
    if (s.startsWith('phase-')) return s;
    if (['1','2','3'].includes(s)) return 'phase-'+s;
    return 'phase-1';
  }
  function getQuery(){
    const qs   = new URLSearchParams(window.location.search);
    const hash = new URLSearchParams((window.location.hash||'').replace(/^#/, ''));
    const q = (k)=> qs.get(k) || hash.get(k);
    return { group:(q('group')||'').toLowerCase(), phase:(q('phase')||'1').toLowerCase() };
  }
  function setPhaseLabel(phaseKey){
    const ph = phases.find(x=>x.key===phaseKey) || phases[0];
    if (labelEl) labelEl.textContent = ph.label;
  }

  function applyPhase1Copy(){
    const map = (overrides && overrides['phase-1']) || {};
    document.querySelectorAll('#standsGrid .news-card').forEach(card=>{
      const key   = card.getAttribute('data-group');
      const base  = groups[key] || {};
      const ov    = map[key] || {};
      const titleEl = card.querySelector('.js-stand-title');
      const introEl = card.querySelector('.js-stand-intro');

      if (titleEl) titleEl.textContent = ov.title || base.title || '';
      if (introEl) introEl.textContent = ov.intro || base.intro || '';

    
      const a = card.querySelector('.js-stand-link');
      if (a) {
        const url = new URL(targetBase, window.location.origin);
        if (key) url.searchParams.set('group', key);
        url.searchParams.set('phase', '1');
        a.href = url.toString();
      }
    });
  }

 
  function applyPhase(phaseKey){
    setPhaseLabel(phaseKey);

    if (phaseKey === 'phase-1') {
    
      if (grid) {
        grid.innerHTML = phase1HTML;
        applyPhase1Copy();
      }
      if (notice) notice.style.display = 'none'; 
      return;
    }

 
    if (grid) grid.innerHTML = '';
  
    if (notice) {
      const nice = (phaseKey === 'phase-2') ? 'Phase 2' : 'Phase 3';
      notice.textContent = `${nice} — content will be added soon.`;
      notice.style.display = '';
    }
  }

  function selectPhaseByIndex(i){
    const ph = phases[i] || phases[0];
    picker.dataset.current = String(i);
    options.forEach(o => o.setAttribute('aria-selected', (o.dataset.index==i ? 'true':'false')));
    applyPhase(ph.key);
  }

  if (btn && menu) {
    btn.addEventListener('click', ()=> menu.classList.contains('is-open') ? closeMenu() : openMenu());
    document.addEventListener('click', (e)=> { if (!picker.contains(e.target)) closeMenu(); });
    options.forEach(o => o.addEventListener('click', ()=>{ selectPhaseByIndex(+o.dataset.index); closeMenu(); }));
  }

 
  const {phase: p} = getQuery();
  const phaseKey   = normPhase(p);
  const startIndex = Math.max(0, phases.findIndex(x=>x.key===phaseKey));
  selectPhaseByIndex(startIndex === -1 ? 0 : startIndex);
})();
</script>

<?php get_footer(); ?>
