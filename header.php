<!doctype html>
<html <?php language_attributes(); ?>>
    
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

  <!-- Nav-Bar -->
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

<script>
(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    // Use global navPreviewData if it exists, otherwise use inline config.
    const previewData = window.navPreviewData || <?php
      echo wp_json_encode( [
        'residential' => [
          'items' => [
            [
              'title' => '400 sqm Stands',
              'link'  => site_url('/residential-2'),
              'image' => get_stylesheet_directory_uri() . '/assets/images/stands/stand-1.png',
            ],
            [
              'title' => '500-600 sqm Stands',
              'link'  => site_url('/residential-2'),
              'image' => get_stylesheet_directory_uri() . '/assets/images/stands/stand-2.png',
            ],
            [
              'title' => '1200 sqm Stands',
              'link'  => site_url('/residential-2'),
              'image' => get_stylesheet_directory_uri() . '/assets/images/stands/stand-3.png',
            ],
            [
              'title' => 'Cluster Housing / Garden Apartments',
              'link'  => site_url('/residential-2'),
              'image' => get_stylesheet_directory_uri() . '/assets/images/stands/stand-4.png',
            ],
          ],
        ],
      ] );
    ?>;

    let card = document.getElementById("navPreviewCard");
    if (!card) {
      card = document.createElement("div");
      card.id = "navPreviewCard";
      card.className = "nav-preview-card";
      card.setAttribute("aria-hidden", "true");
      document.body.appendChild(card);
    }

    function normalizeKey(text) {
      return (text || "").replace(/\s+/g, " ").trim().toLowerCase();
    }

    const nav =
      document.querySelector(".navbar-nav") ||
      document.querySelector("nav") ||
      document.querySelector("ul");
    if (!nav) return;

    let hideTimeout = null;
    function clearHideTimeout() {
      if (hideTimeout) {
        clearTimeout(hideTimeout);
        hideTimeout = null;
      }
    }

    function buildGrid(items) {
      if (!Array.isArray(items)) return "";
      const grid = document.createElement("div");
      grid.className = "nav-preview-grid";
      items.forEach((item) => {
        const a = document.createElement("a");
        a.href = item.link || "#";
        a.className = "nav-preview-card-item";
        a.innerHTML =
          '<img class="card-thumb" src="' +
          (item.image || "") +
          '" alt="' +
          (item.title || "") +
          '">' +
          '<span class="card-title">' +
          (item.title || "") +
          "</span>";
        grid.appendChild(a);
      });
      return grid;
    }

    function buildSingle(data) {
      const wrap = document.createElement("div");
      wrap.className = "nav-preview-single";
      const img = document.createElement("img");
      img.src = data.image || "";
      img.alt = data.title || "";
      const txt = document.createElement("div");
      txt.className = "single-text";
      const h4 = document.createElement("h4");
      h4.textContent = data.title || "";
      const p = document.createElement("p");
      p.textContent = data.text || "";
      txt.appendChild(h4);
      txt.appendChild(p);
      wrap.appendChild(img);
      wrap.appendChild(txt);
      return wrap;
    }

    function showCardForLink(linkEl) {
      clearHideTimeout();
      const key = normalizeKey(linkEl.textContent);
      const data = previewData[key];
      if (!data) return hideCardImmediate();

      // clear card contents
      card.innerHTML = "";

      // create inner centered wrapper
      const inner = document.createElement("div");
      inner.className = "nav-preview-inner";

      // build content (grid or single) and append into inner
      if (Array.isArray(data.items) && data.items.length) {
        const grid = buildGrid(data.items);
        inner.appendChild(grid);
      } else {
        const single = buildSingle(data);
        if (data.link) {
          const wrapperLink = document.createElement("a");
          wrapperLink.href = data.link;
          wrapperLink.appendChild(single);
          inner.appendChild(wrapperLink);
        } else {
          inner.appendChild(single);
        }
      }

      card.appendChild(inner);

      // position under the link (keep vertical positioning behavior)
      const linkRect = linkEl.getBoundingClientRect();
      const top = Math.max(12, linkRect.bottom + 10);
      card.style.top = top + "px";

      // Make card full viewport width (left/right set via CSS) and ensure visible
      card.style.left = "0px";
      card.style.width = "100%";
      card.classList.add("show");
      card.setAttribute("aria-hidden", "false");
    }

    function hideCardImmediate() {
      clearHideTimeout();
      card.classList.remove("show");
      card.setAttribute("aria-hidden", "true");
    }

    function hideCardWithDelay(delay = 100) {
      clearHideTimeout();
      hideTimeout = setTimeout(function () {
        if (card.matches(":hover")) return;
        const links = Array.from(nav.querySelectorAll("a"));
        const hoveredLink = links.find((l) => l.matches(":hover"));
        if (hoveredLink && previewData[normalizeKey(hoveredLink.textContent)]) {
          showCardForLink(hoveredLink);
          return;
        }
        hideCardImmediate();
      }, delay);
    }

    const links = nav.querySelectorAll("a");
    links.forEach((link) => {
      const key = normalizeKey(link.textContent);
      if (!previewData[key]) return;

      link.addEventListener("mouseenter", function () {
        clearHideTimeout();
        showCardForLink(link);
      });
      link.addEventListener("focus", function () {
        clearHideTimeout();
        showCardForLink(link);
      });

      link.addEventListener("mouseleave", function () {
        const hoveredLink = Array.from(links).find((l) => l.matches(":hover"));
        if (hoveredLink && previewData[normalizeKey(hoveredLink.textContent)]) {
          showCardForLink(hoveredLink);
          return;
        }
        hideCardWithDelay(80);
      });

      link.addEventListener("blur", function () {
        hideCardWithDelay(60);
      });
    });

    card.addEventListener("mouseenter", function () {
      clearHideTimeout();
      card.classList.add("show");
    });
    card.addEventListener("mouseleave", function () {
      hideCardWithDelay(80);
    });

    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") hideCardImmediate();
    });
    window.addEventListener("resize", hideCardImmediate);
    window.addEventListener("scroll", hideCardImmediate, { passive: true });
  });
})();
</script>

<script>
(function(){
  const picker = document.querySelector('.plan-picker');
  if (!picker) return;

  const btn      = picker.querySelector('.plan-button');
  const labelEl  = picker.querySelector('.plan-button-label');
  const menu     = picker.querySelector('.plan-menu');
  const options  = menu ? [...menu.querySelectorAll('.plan-option')] : [];
  const hero     = document.getElementById('plan-hero');

  const specList   = document.getElementById('spec-list');
  const totalLabel = document.getElementById('total-label');
  const totalValue = document.getElementById('total-value');

  const plans = <?php echo wp_json_encode( $plans ); ?> || [];
  if (!plans.length || !btn || !menu) return;

  function openMenu(){
    menu.classList.add('is-open');
    btn.setAttribute('aria-expanded','true');
    menu.focus({preventScroll:true});
    const i = +picker.dataset.current || 0;
    const el = menu.querySelector('.plan-option[data-index="'+i+'"]');
    if (el) el.scrollIntoView({block:'nearest'});
  }
  function closeMenu(){
    menu.classList.remove('is-open');
    btn.setAttribute('aria-expanded','false');
  }

  function renderSpecs(i){
    const p = plans[i];
    if (!p) return;
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

  function selectIndex(i){
    const p = plans[i];
    if (!p) return;

    picker.dataset.current = String(i);
    if (labelEl) labelEl.textContent = p.title || 'Plan';
    if (hero) { hero.src = p.img || hero.src; hero.alt = p.title || hero.alt || ''; }

    renderSpecs(i);

    options.forEach(o => {
      o.setAttribute('aria-selected', (o.dataset.index == i ? 'true' : 'false'));
    });

    closeMenu();
    btn.focus({preventScroll:true});
  }

  btn.addEventListener('click', () => {
    menu.classList.contains('is-open') ? closeMenu() : openMenu();
  });

  options.forEach(o => {
    o.addEventListener('click', () => selectIndex(+o.dataset.index));
  });

  document.addEventListener('click', (e) => {
    if (!picker.contains(e.target)) closeMenu();
  });

  menu.addEventListener('keydown', (e) => {
    const cur = +picker.dataset.current || 0;
    if (e.key === 'Escape') { e.preventDefault(); closeMenu(); btn.focus(); }
    if (e.key === 'ArrowDown') { e.preventDefault(); selectIndex(Math.min(cur + 1, plans.length - 1)); openMenu(); }
    if (e.key === 'ArrowUp') { e.preventDefault(); selectIndex(Math.max(cur - 1, 0)); openMenu(); }
    if (e.key === 'Enter') { e.preventDefault(); closeMenu(); btn.focus(); }
  });

  // Cards hook (if you kept the "View Other Plans" cards)
  document.querySelectorAll('.js-pick-plan').forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const i = parseInt(link.dataset.planIndex, 10);
      if (Number.isInteger(i)) selectIndex(i);
      document.getElementById('house-layout-title')?.scrollIntoView({behavior:'smooth', block:'start'});
    });
  });

  // Initial selection (sync everything)
  picker.dataset.current = picker.dataset.current ?? '0';
  selectIndex(+picker.dataset.current);
})();
</script>
