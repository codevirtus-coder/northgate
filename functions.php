<?php
/**
 * Northgate theme functions (TT4 references removed)
 */


/* -----------------------------------------------------------
 * 1) Theme setup (menus + thumbnails + post formats)
 * ----------------------------------------------------------- */
add_action('after_setup_theme', function () {
	add_theme_support('menus');

	register_nav_menus([
		'main_menu'   => __('Main Menu', 'northgate'),
		'footer_menu' => __('Footer Menu', 'northgate'),
		'top_menu'    => __('Top Menu', 'northgate'),
	]);

	add_theme_support('post-thumbnails');

	remove_theme_support('wp-block-styles'); 
    remove_theme_support('editor-styles');  

	add_theme_support('post-formats', ['aside','image','video','gallery','quote','link']);
});




add_action('admin_enqueue_scripts', function () {
    if (!did_action('wp_enqueue_media')) {
        wp_enqueue_media();
    }
});


// add_action('add_meta_boxes', function () {
 
//     $types = ['post'];

//     foreach ($types as $pt) {
        
//         remove_meta_box('postimagediv', $pt, 'side');

//         add_meta_box(
//             'postimagediv',
//             __('Featured image'),
//             'post_thumbnail_meta_box',
//             $pt,
//             'normal', 
//             'low'    
//         );
//     }
// }, 100);

// add_filter('hidden_meta_boxes', function ($hidden, $screen) {
//     if (isset($screen->post_type) && in_array($screen->post_type, ['post'], true)) {
//         $hidden = is_array($hidden) ? array_diff($hidden, ['postimagediv']) : [];
//     }
//     return $hidden;
// }, 10, 2);


add_filter( 'block_categories_all', function( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'northgate-blocks',
                'title' => __( 'Northgate Blocks', 'northgate' ),
                'icon'  => 'layout',
            ),
        )
    );
}, 10, 2 );


/* -----------------------------------------------------------
 * 2) Assets (Bootstrap, Icons, Google Font, Theme CSS, Bootstrap JS)
 * ----------------------------------------------------------- */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('northgate-style', get_stylesheet_uri());

    wp_enqueue_style(
        'swiper-css',
        get_template_directory_uri() . '/assets/css/swiper-bundle.min.css',
        [],
        null
    );

    wp_enqueue_script(
        'bootstrap-js',
        get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'swiper',
        get_template_directory_uri() . '/assets/js/swiper-bundle.min.js',
        [],
        '1.5.5',
        true
    );

    wp_enqueue_script(
        'northgate-app',
        get_template_directory_uri() . '/assets/js/sliders.js',
        ['swiper'],
        null,
        true
    );
}, 20);





/* -----------------------------------------------------------
 * 3) Menu item Bootstrap classes
 * ----------------------------------------------------------- */
add_filter('nav_menu_css_class', function ($classes, $item, $args) {
	if (!empty($args->theme_location) && $args->theme_location === 'main_menu') {
		if (!in_array('nav-item', $classes, true)) $classes[] = 'nav-item';
		if (in_array('menu-item-has-children', $classes, true) && !in_array('dropdown', $classes, true)) {
			$classes[] = 'dropdown';
		}
	}
	return $classes;
}, 10, 3);

add_filter('nav_menu_link_attributes', function ($atts, $item, $args) {
	if (!empty($args->theme_location) && $args->theme_location === 'main_menu') {
		$atts['class'] = (isset($atts['class']) ? $atts['class'].' ' : '').'nav-link';
		if (in_array('menu-item-has-children', (array) $item->classes, true)) {
			$atts['class'] .= ' dropdown-toggle';
			$atts['role'] = 'button';
			$atts['data-bs-toggle'] = 'dropdown';
			$atts['aria-expanded'] = 'false';
		}
	}
	return $atts;
}, 10, 3);



/* -----------------------------------------------------------
 * 4) Slider CPT 
 * ----------------------------------------------------------- */
add_action('init', function () {
	register_post_type('northgate-slider', [
		'labels' => [
			'name'          => __('Northgate Slider'),
			'singular_name' => __('Northgate Slider'),
			'add_new_item'  => __('Add New Northgate Slider'),
			'add_new'       => __('Add New Northgate Slider'),
			'attributes'    => __('Northgate Slider Attributes', 'text_domain'),
		],
		'public'        => true,
		'hierarchical'  => false,
		'rewrite'       => ['slug' => 'northgate-slider'],
		'supports'      => ['title','thumbnail','page-attributes'],
		'menu_position' => 5,
		'menu_icon'     => 'dashicons-images-alt2',
	]);
});





/* -----------------------------------------------------------
 * 5) Designs CPT 
 * ----------------------------------------------------------- */
add_action('init', function () {
	register_post_type('designs', [
		'labels' => [
			'name'          => __('Designs'),
			'singular_name' => __('Designs'),
			'add_new_item'  => __('Add New Designs'),
			'add_new'       => __('Add New Designs'),
		],
		'public'        => true,
		'hierarchical'  => false,
		'rewrite'       => ['slug' => 'designs'],
		'supports'      => ['title'],
		'menu_position' => 5,
		'menu_icon'     => 'dashicons-images-alt2',
	]);
});





/* -----------------------------------------------------------
 * 6) Nav Preview script + data
 * ----------------------------------------------------------- */
// add_action('wp_enqueue_scripts', function () {
// 	$handle = 'nav-card-hover';
// 	$path   = get_stylesheet_directory() . '/assets/js/nav-card-hover.js';

// 	wp_enqueue_script(
// 		$handle,
// 		get_stylesheet_directory_uri() . '/assets/js/nav-card-hover.js',
// 		[],
// 		file_exists($path) ? filemtime($path) : false,
// 		true
// 	);

// 	$preview_data = [
// 		'residential' => [
// 			'items' => [
// 				[
// 					'title' => '400 sqm Stands',
// 					'link'  => site_url('/residential-2'),
// 					'image' => get_stylesheet_directory_uri() . '/assets/images/stands/stand-1.png',
// 				],
// 				[
// 					'title' => '500-600 sqm Stands',
// 					'link'  => site_url('/residential-2'),
// 					'image' => get_stylesheet_directory_uri() . '/assets/images/stands/stand-2.png',
// 				],
// 				[
// 					'title' => '1200 sqm Stands',
// 					'link'  => site_url('/residential-2'),
// 					'image' => get_stylesheet_directory_uri() . '/assets/images/stands/stand-3.png',
// 				],
// 				[
// 					'title' => 'Cluster Housing / Garden Apartments',
// 					'link'  => site_url('/residential-2'),
// 					'image' => get_stylesheet_directory_uri() . '/assets/images/stands/stand-4.png',
// 				],
// 			],
// 		],
// 	];

// 	wp_localize_script($handle, 'navPreviewData', $preview_data);
// }, 25);



/* -----------------------------------------------------------
 * 7) Carbon Fields meta/option containers
 * ----------------------------------------------------------- */
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;


add_filter( 'wpcf7_load_css', '__return_false' );

add_action('carbon_fields_register_fields', function () {

	// Slider fields
	Container::make('post_meta', 'Northgate Slider')
		->where('post_type', '=', 'northgate-slider')
		->add_fields([
			Field::make('text',  'slider_home_text', 'Slide Headline (optional)')->set_width(50),
			Field::make('text',  'slider_btn_text',  'Button Text')->set_width(50),
			Field::make('text',  'slider_btn_url',   'Button URL')->set_width(50),
	]);

	// Post/Page Banner
	Container::make('post_meta', 'Banner')
		->where('post_type', '=', 'page')
		->add_fields([
			Field::make('text',  'banner_headline', 'Banner Headline'),
			Field::make('image', 'banner_image',    'Banner Image'),
	]);


    // Contact Settings (Theme Options)
Container::make('theme_options', 'Contact Settings')
    ->set_icon('dashicons-email') // optional
    ->add_fields([
        Field::make('text', 'northgate_contact_address', 'Address')
            ->set_width(100)
            ->set_attribute('placeholder', '123 Northgate Drive, Harare'),

        Field::make('text', 'northgate_contact_email', 'Email')
            ->set_width(50)
            ->set_attribute('placeholder', 'info@northgate.co.zw'),

        Field::make('text', 'northgate_contact_phone', 'Phone/Mobile')
            ->set_width(50)
            ->set_attribute('placeholder', '+263 77 000 0000'),

        Field::make('text', 'northgate_contact_form_shortcode', 'Contact Form Shortcode')
            ->set_width(100)
            ->set_help_text('Paste your Contact Form 7 shortcode here, e.g. [contact-form-7 id="123" title="Contact Form"]'),

        Field::make('textarea', 'northgate_contact_google_map', 'Google Map iframe')
            ->set_width(100)
            ->set_rows(7)
            ->set_attribute('placeholder', 'Paste Google Maps <iframe> code here...')
    ]);




	// Designs
    Container::make( 'post_meta', 'Architectural Designs' )

		->where( 'post_type', '=', 'designs' )
		->add_fields( [
			Field::make('text',  'design_price', 'Total Price')
				->set_attribute( 'placeholder', '400,000' )
				->set_width( 50 ),

			Field::make( 'select', 'design_sizes', 'Land Space' )
				->set_width( 50 )
				->set_options( array(
					'400 Sqm' => '400 Sqm',
					'600 Sqm' => '600 Sqm',
					'1200 Sqm' => '1200 Sqm',
					'Cluster/Apartments' => 'Cluster/Apartments',
				) ),

			Field::make( 'complex', 'design_floor_plan_details', __( 'Floor Plan Details' ) )
				->set_layout( 'tabbed-horizontal' )
				->set_width( 70 )
				->add_fields( [
					Field::make( 'text', 'design_space', __( 'Space' ) )
						->set_width( 50 ),
					Field::make( 'text', 'design_sqm', __( 'SQM' ) )
					->set_attribute( 'placeholder', '86' )
						->set_width( 50 ),
				] ),

			Field::make( 'image', 'design_floor_plan', 'Floor Plan' )
				->set_value_type( 'url' )
				->set_width( 30 ),
			
			Field::make( 'complex', 'design_slider', __( 'Slide Images' ) )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( [
					Field::make( 'image', 'design_images', __( 'Add Image' ) )
						->set_value_type( 'url' )
			]),      
    ] );


	// Card Block
	Block::make( __( 'Card Block' ) )
		->add_fields( array(
			Field::make( 'text', 'card_title', __( 'Title' ) ),
			Field::make( 'textarea', 'card_text', __( 'Text' ) ),
			Field::make( 'image', 'card_image', __( 'Image' ) )
				->set_width( 100 ),
			Field::make( 'text', 'btn_text', 'Button Text' )
				->set_width( 50 ),
			Field::make( 'text', 'btn_link', 'Button URL/Link' )
				->set_width( 50 ),
		) )
        
        ->set_description(__('Display card with image and link'))
        
        ->set_icon('groups')

        ->set_category('zifa-blocks')

        ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
            // Handle link
            $btn_link = $fields['btn_link'] ?? '';
            $href = $btn_link;
            if ($btn_link && ! preg_match('/^(https?:\/\/|\/\/|#)/', $btn_link)) {
                $href = home_url('/') . ltrim($btn_link, '/');
            }

            // Handle image
            $image_url = !empty($fields['card_image']) ? wp_get_attachment_image_url($fields['card_image'], 'full') : '';
            $alt = !empty($fields['card_heading']) ? $fields['card_heading'] : 'Team Member';

            // Background image fallback
            $bg_url = get_theme_file_uri('/img/team/team-bg.webp');

            ?>
            
            <div class="card teams">
                <h3 class="card-title"><?php echo esc_html($fields['card_heading']); ?></h3>
                <?php if ($image_url): ?>
                    <a href="<?= esc_url($href) ?>">
                        <img src="<?= esc_url($image_url) ?>" alt="<?= esc_attr($alt) ?>" class="img-fluid">
                    </a>
                <?php endif; ?>
                <?php if ($btn_link): ?>
                    <a href="<?= esc_url($href) ?>" class="card-link">
                        <?= esc_html($fields['btn_text'] ?? 'Learn More') ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php
        });


	// Theme options
	Container::make('theme_options', 'Site Banner Options')
		->add_fields([
			Field::make('image', 'north_gate_image',     'Default Banner Image'),
			Field::make('text',  'home_banner_headline', 'Home Banner Headline'),
			Field::make('image', '404_banner_image',     '404 Banner Image'),
		]);



		// Hero Two Column Block (simplified)
Block::make( __( 'Hero Two Column', 'northgate' ) )
    ->add_fields( array(
        Field::make( 'text', 'hero_heading', __( 'Heading', 'northgate' ) )
            ->set_width( 100 ),

        Field::make( 'textarea', 'hero_text', __( 'Intro Text', 'northgate' ) )
            ->set_rows( 4 )
            ->set_width( 100 ),

        Field::make( 'text', 'hero_btn_text', __( 'Button Text', 'northgate' ) )
            ->set_width( 50 ),

        Field::make( 'text', 'hero_btn_link', __( 'Button URL/Link', 'northgate' ) )
            ->set_width( 50 ),

        Field::make( 'image', 'hero_image', __( 'Hero Image', 'northgate' ) )
            ->set_width( 100 ),
    ) )
    ->set_description( __( 'Two-column hero with text and image', 'northgate' ) )
    ->set_icon( 'align-wide' )
    ->set_category( 'northgate-blocks' )
    ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {
        ?>
        <section class="container-fluid mx-auto hero-two-col">

            <div class="hero-text">
                <h2 class="section-heading">
                    <?php echo esc_html( $fields['hero_heading'] ?? '' ); ?>
                </h2>

                <?php if ( ! empty( $fields['hero_text'] ) ) : ?>
                    <p class="section-lead">
                        <?php echo esc_html( $fields['hero_text'] ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( ! empty( $fields['hero_btn_link'] ) ) : ?>
                    <a class="btn-secondary" href="<?php echo esc_url( $fields['hero_btn_link'] ); ?>">
                        <?php echo esc_html( $fields['hero_btn_text'] ?? '' ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <div class="hero-image has-overlay">
                <?php
                // Single small bit of logic to get the URL or fallback
                $hero_img = '';
                if ( ! empty( $fields['hero_image'] ) ) {
                    $hero_img = wp_get_attachment_image_url( $fields['hero_image'], 'full' );
                }
                if ( ! $hero_img ) {
                    $hero_img = get_template_directory_uri() . '/assets/images/Rectangle 17.png';
                }
                ?>
                <img src="<?php echo esc_url( $hero_img ); ?>" alt="">
                <span class="img-overlay" aria-hidden="true"></span>
            </div>

        </section>
        <?php
    } );


 // Split Hero Block
Block::make( __( 'Split Hero', 'northgate' ) )
    ->add_fields( array(
        Field::make( 'text', 'hero_headline', __( 'Headline', 'northgate' ) )
            ->set_help_text( 'Use line breaks in the editor where you want new lines (they will become <br>).' ),

        Field::make( 'textarea', 'hero_intro', __( 'Intro Text', 'northgate' ) )
            ->set_rows( 5 ),

        Field::make( 'complex', 'hero_stats', __( 'Stats', 'northgate' ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'stat_number', __( 'Number', 'northgate' ) )
                    ->set_width( 30 ),
                Field::make( 'textarea', 'stat_text', __( 'Text', 'northgate' ) )
                    ->set_rows( 2 )
                    ->set_width( 70 ),
            ) ),

        Field::make( 'text', 'learn_link', __( '"Learn more" URL', 'northgate' ) )
            ->set_help_text( 'e.g. /about or full URL' )
            ->set_width( 50 ),

        Field::make( 'text', 'invest_link', __( '"Invest to live here" URL', 'northgate' ) )
            ->set_width( 50 ),

        Field::make( 'image', 'right_image', __( 'Right Image', 'northgate' ) )
            ->set_help_text( 'Hero image on the right side' ),
    ) )
    ->set_description( __( 'Split hero: text left, image + CTAs right', 'northgate' ) )
    ->set_icon( 'align-pull-right' )
    ->set_category( 'northgate-blocks' )
    ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {

        $headline   = $fields['hero_headline'] ?? 'WHERE LIFE FINDS ITS SPACE';
        $intro      = $fields['hero_intro'] ?? '';
        $stats      = is_array( $fields['hero_stats'] ?? null ) ? $fields['hero_stats'] : array();
        $learn_link = $fields['learn_link'] ?? '';
        $invest_link= $fields['invest_link'] ?? '';
        $right_img  = '';

        if ( ! empty( $fields['right_image'] ) ) {
            $right_img = wp_get_attachment_image_url( $fields['right_image'], 'full' );
        }

        // Fallback image if nothing set
        if ( ! $right_img ) {
            $right_img = get_template_directory_uri() . '/assets/images/hero-placeholder.jpg';
        }
        ?>
        <section class="split-hero" aria-label="<?php echo esc_attr( $headline ); ?>">
          <div class="split-hero-inner">

            <!-- LEFT: text -->
            <div class="hero-left" style="--left-bg: url('<?php echo esc_url( $right_img ); ?>')">
              <div class="container-fluid">
                <h1 class="hero-headline">
                  <?php echo wp_kses_post( nl2br( esc_html( $headline ) ) ); ?>
                </h1>

                <?php if ( $intro ) : ?>
                  <p class="section-lead">
                    <?php echo esc_html( $intro ); ?>
                  </p>
                <?php endif; ?>

                <?php if ( ! empty( $stats ) ) : ?>
                  <div class="hero-stats">
                    <?php foreach ( $stats as $stat ) :
                        $num  = $stat['stat_number'] ?? '';
                        $text = $stat['stat_text'] ?? '';
                        if ( ! $num && ! $text ) {
                            continue;
                        }
                        ?>
                        <div class="stat">
                          <?php if ( $num ) : ?>
                            <div class="stat-number"><?php echo esc_html( $num ); ?></div>
                          <?php endif; ?>

                          <?php if ( $text ) : ?>
                            <div class="section-lead"><?php echo esc_html( $text ); ?></div>
                          <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <!-- RIGHT: image + CTAs -->
            <div class="hero-right">
              <div class="cta-group" role="group" aria-label="primary actions">
                <?php if ( $learn_link ) : ?>
                  <div class="cta-primary">
                    <a class="cta-primary" href="<?php echo esc_url( $learn_link ); ?>">
                      LEARN MORE
                    </a>
                  </div>
                <?php endif; ?>

                <?php if ( $invest_link ) : ?>
                  <div class="cta-ghost">
                    <a class="btn-ghost" href="<?php echo esc_url( $invest_link ); ?>">
                      INVEST TO LIVE HERE
                    </a>
                  </div>
                <?php endif; ?>
              </div>

              <div class="hero-image-wrap" aria-hidden="false">
                <img class="hero-image"
                     src="<?php echo esc_url( $right_img ); ?>"
                     alt="<?php echo esc_attr( $headline ); ?>">
              </div>
            </div>

          </div>
        </section>
        <?php
    } );
   
// Hero Two Column (rich version with list + secondary image)
Block::make( __( 'Hero Two Column Rich', 'northgate' ) )
    ->add_fields( array(
        Field::make( 'text', 'hero_heading', __( 'Heading', 'northgate' ) )
            ->set_help_text( 'You can add line breaks, e.g. "WHERE YOU,\nLIVE CAN CHANGE\nYOUR LIFE".' ),

        Field::make( 'textarea', 'hero_intro', __( 'Intro Text', 'northgate' ) )
            ->set_rows( 6 ),

        Field::make( 'text', 'features_heading', __( 'Features Heading', 'northgate' ) )
            ->set_default_value( 'Key Features' ),

        Field::make( 'complex', 'hero_features', __( 'Feature Items', 'northgate' ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'textarea', 'feature_text', __( 'Feature Text', 'northgate' ) )
                    ->set_rows( 2 ),
            ) ),

        Field::make( 'text', 'btn_text', __( 'Button Text', 'northgate' ) )
            ->set_default_value( 'LEARN MORE' )
            ->set_width( 50 ),

        Field::make( 'text', 'btn_link', __( 'Button URL/Link', 'northgate' ) )
            ->set_help_text( 'e.g. /residential or full URL' )
            ->set_width( 50 ),

        Field::make( 'image', 'datvest_image', __( 'Small Left Image', 'northgate' ) )
            ->set_help_text( 'The small Datvest-style image next to the button.' ),

        Field::make( 'image', 'hero_image', __( 'Main Right Image', 'northgate' ) )
            ->set_help_text( 'Large hero image on the right.' ),
    ) )
    ->set_description( __( 'Two-column hero with text, feature list, CTA + two images', 'northgate' ) )
    ->set_icon( 'align-pull-right' )
    ->set_category( 'northgate-blocks' )
    ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {

        $heading         = $fields['hero_heading']      ?? 'WHERE YOU, LIVE CAN CHANGE YOUR LIFE';
        $intro           = $fields['hero_intro']        ?? '';
        $features_heading= $fields['features_heading']  ?? '';
        $features        = is_array( $fields['hero_features'] ?? null ) ? $fields['hero_features'] : array();
        $btn_text        = $fields['btn_text']          ?? 'LEARN MORE';
        $btn_link        = $fields['btn_link']          ?? '';
        $datvest_img_url = '';
        $hero_img_url    = '';

        if ( ! empty( $fields['datvest_image'] ) ) {
            $datvest_img_url = wp_get_attachment_image_url( $fields['datvest_image'], 'full' );
        } else {
            $datvest_img_url = get_template_directory_uri() . '/assets/images/icons/image 33.png';
        }

        if ( ! empty( $fields['hero_image'] ) ) {
            $hero_img_url = wp_get_attachment_image_url( $fields['hero_image'], 'full' );
        } else {
            $hero_img_url = get_template_directory_uri() . '/assets/images/Rectangle 17.png';
        }
        ?>
        <section class="container-fluid">
          <div class="hero-two-col py-5">

            <div class="hero-text">
              <h2 class="section-heading">
                <?php echo wp_kses_post( nl2br( esc_html( $heading ) ) ); ?>
              </h2>

              <?php if ( $intro ) : ?>
                <p class="section-lead">
                  <?php echo esc_html( $intro ); ?>
                </p>
              <?php endif; ?>

              <?php if ( $features_heading ) : ?>
                <h3 class="section-lead">
                  <?php echo esc_html( $features_heading ); ?>
                </h3>
              <?php endif; ?>

              <?php if ( ! empty( $features ) ) : ?>
                <ul class="section-lead">
                  <?php foreach ( $features as $feature ) :
                      $text = $feature['feature_text'] ?? '';
                      if ( ! $text ) {
                          continue;
                      }
                      ?>
                      <li><?php echo esc_html( $text ); ?></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>

              <div class="d-flex flex-wrap gap-3 align-items-center">
                <?php if ( $btn_link ) : ?>
                  <a class="btn-secondary" href="<?php echo esc_url( $btn_link ); ?>">
                    <?php echo esc_html( $btn_text ); ?>
                  </a>
                <?php endif; ?>

                <?php if ( $datvest_img_url ) : ?>
                  <div class="datvest-image">
                    <img src="<?php echo esc_url( $datvest_img_url ); ?>" alt="Residential pool and courtyard">
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="hero-image">
              <?php if ( $hero_img_url ) : ?>
                <img src="<?php echo esc_url( $hero_img_url ); ?>" alt="Residential pool and courtyard">
              <?php endif; ?>
            </div>

          </div>
        </section>
        <?php
    } );


// Lifestyle / Cluster Homes Block 
Block::make( __( 'Lifestyle Homes Grid', 'northgate' ) )
    ->add_fields( array(
        Field::make( 'text', 'lifestyle_heading', __( 'Heading', 'northgate' ) ),

        Field::make( 'textarea', 'lifestyle_intro', __( 'Intro Text', 'northgate' ) )
            ->set_rows( 3 ),

        Field::make( 'complex', 'lifestyle_cards', __( 'Cards', 'northgate' ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'image', 'card_image', __( 'Card Image', 'northgate' ) )
                    ->set_value_type( 'url' ),

                Field::make( 'text', 'card_title', __( 'Title', 'northgate' ) ),

                Field::make( 'text', 'card_subtitle', __( 'Subtitle', 'northgate' ) ),

                Field::make( 'text', 'card_link', __( 'Link URL (optional)', 'northgate' ) ),
            ) ),

        Field::make( 'text', 'lifestyle_btn_text', __( 'Button Text', 'northgate' ) ),

        Field::make( 'text', 'lifestyle_btn_link', __( 'Button URL/Link', 'northgate' ) ),
    ) )
    ->set_description( __( 'Lifestyle homes grid section with manual cards', 'northgate' ) )
    ->set_icon( 'grid-view' )
    ->set_category( 'northgate-blocks' )
    ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {

        $heading  = $fields['lifestyle_heading']   ?? '';
        $intro    = $fields['lifestyle_intro']     ?? '';
        $btn_text = $fields['lifestyle_btn_text']  ?? '';
        $btn_link = $fields['lifestyle_btn_link']  ?? '';
        $cards    = is_array( $fields['lifestyle_cards'] ?? null )
            ? $fields['lifestyle_cards']
            : array();
        ?>

        <section class="">
            <div class="lifestyle-section">
                <div class="container-fluid">
                    <div class="lifestyle-header">
                        <h2 class="section-heading">
                            <?php echo wp_kses_post( $heading ); ?>
                        </h2>

                        <div class="lifestyle-intro">
                            <p class="section-lead">
                                <?php echo wp_kses_post( $intro ); ?>
                            </p>
                        </div>
                    </div>

                    <div class="lifestyle-grid">
                     <?php foreach ( $cards as $card ) :
    $img       = $card['card_image']    ?? '';
    $title     = $card['card_title']    ?? '';
    $subtitle  = $card['card_subtitle'] ?? '';
    $raw_link  = trim( $card['card_link'] ?? '' );

    $href = '';

    if ( $raw_link !== '' ) {

        if ( preg_match( '#^https?://#i', $raw_link ) ) {
            $href = $raw_link;

        } else {
            $slug = sanitize_title( $raw_link );
            $href = home_url( '/' . $slug . '/' );
        }
    }
    ?>

    <article class="home-card" style="background-image:url('<?php echo esc_url( $img ); ?>')">

        <?php if ( $href ) : ?>
            <a href="<?php echo esc_url( $href ); ?>"
               class="home-card-link"
               aria-label="<?php echo esc_attr( $title ?: $raw_link ); ?>">
            </a>
        <?php endif; ?>

        <div class="home-card-caption">
            <?php if ( $title ) : ?>
                <strong><?php echo esc_html( $title ); ?></strong>
            <?php endif; ?>

            <?php if ( $subtitle ) : ?>
                <span class="muted"><?php echo esc_html( $subtitle ); ?></span>
            <?php endif; ?>
        </div>

    </article>

<?php endforeach; ?>


</div>


                    <div class="lifestyle-cta-wrap">
                        <?php if ( $btn_link ) : ?>
                            <a class="btn-secondary" href="<?php echo esc_url( $btn_link ); ?>">
                                <?php echo esc_html( $btn_text ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    } );


// "What's in It" Feature List Block
Block::make( __( "What's In It", 'northgate' ) )
    ->add_fields( array(
        Field::make( 'text', 'heading', __( 'Heading', 'northgate' ) )
            ->set_default_value( "What's in It" )
            ->set_width( 100 ),

        Field::make( 'complex', 'features', __( 'Features', 'northgate' ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'image', 'icon', __( 'Icon', 'northgate' ) )
                    ->set_help_text( 'Small icon shown to the left of each feature.' )
                    ->set_width( 30 ),

                Field::make( 'text', 'title', __( 'Feature Title', 'northgate' ) )
                    ->set_width( 70 ),

                Field::make( 'textarea', 'text', __( 'Feature Text', 'northgate' ) )
                    ->set_rows( 3 )
                    ->set_width( 100 ),
            ) ),

        Field::make( 'image', 'right_image', __( 'Right Image', 'northgate' ) )
            ->set_help_text( 'Main image on the right.' ),
    ) )
    ->set_description( __( 'Two-column "What\'s in It" section with icon list and right image', 'northgate' ) )
    ->set_icon( 'list-view' )
    ->set_category( 'northgate-blocks' )
    ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {

        $heading  = $fields['heading'] ?? "What's in It";
        $features = is_array( $fields['features'] ?? null ) ? $fields['features'] : array();

        // Right image
        $what_right_image = '';
        if ( ! empty( $fields['right_image'] ) ) {
            $what_right_image = wp_get_attachment_image_url( $fields['right_image'], 'full' );
        }
        // Optional fallback if you want:
        // if ( ! $what_right_image ) {
        //     $what_right_image = get_template_directory_uri() . '/assets/images/your-fallback.png';
        // }
        ?>
        <section class="container-fluid">
          <div class="hero-two-col">

            <div class="hero-text">
              <div class="d-flex align-items-center mb-4">
                <h2 class="section-heading">
                  <?php echo esc_html( $heading ); ?>
                </h2>
                <div class="flex-grow-1 ms-3 title-divider"></div>
              </div>

              <?php if ( ! empty( $features ) ) : ?>
                <div class="row gy-4">
                  <?php foreach ( $features as $feat ) :
                      $icon_id = $feat['icon']  ?? '';
                      $title   = $feat['title'] ?? '';
                      $text    = $feat['text']  ?? '';

                      $icon_url = '';
                      if ( $icon_id ) {
                          $icon_url = wp_get_attachment_image_url( $icon_id, 'full' );
                      }
                      ?>
                      <div class="col-12 d-flex">
                        <?php if ( $icon_url ) : ?>
                          <img
                            src="<?php echo esc_url( $icon_url ); ?>"
                            alt="<?php echo esc_attr( $title ); ?>"
                            class="feature-icon me-3"
                          >
                        <?php endif; ?>

                        <div>
                          <?php if ( $title ) : ?>
                            <h5 class="feature-title"><?php echo esc_html( $title ); ?></h5>
                          <?php endif; ?>

                          <?php if ( $text ) : ?>
                            <p class="section-lead"><?php echo esc_html( $text ); ?></p>
                          <?php endif; ?>
                        </div>
                      </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="hero-image">
              <?php if ( $what_right_image ) : ?>
                <img
                  src="<?php echo esc_url( $what_right_image ); ?>"
                  alt="<?php esc_attr_e( 'Estate preview', 'northgate' ); ?>"
                >
              <?php endif; ?>
            </div>

          </div>
        </section>
        <?php
    } );


// Retail / Light Industrial Section Block
Block::make( __( 'Retail / Light Industrial', 'northgate' ) )
    ->add_fields( array(
        Field::make( 'text', 'retail_heading', __( 'Heading', 'northgate' ) ),

        Field::make( 'textarea', 'retail_intro', __( 'Intro Paragraph', 'northgate' ) )
            ->set_rows( 4 ),

        Field::make( 'textarea', 'retail_intro_secondary', __( 'Secondary Paragraph', 'northgate' ) )
            ->set_rows( 3 ),

        Field::make( 'complex', 'retail_list_items', __( 'List Items', 'northgate' ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'item_text', __( 'Item Text', 'northgate' ) ),
            ) ),

        Field::make( 'image', 'retail_image', __( 'Right Image', 'northgate' ) ),
    ) )
    ->set_description( __( 'Retail / Light Industrial two-column section with text and image', 'northgate' ) )
    ->set_icon( 'store' )
    ->set_category( 'northgate-blocks' )
    ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {

        $heading      = $fields['retail_heading']           ?? '';
        $intro        = $fields['retail_intro']             ?? '';
        $intro_second = $fields['retail_intro_secondary']   ?? '';
        $list_items   = is_array( $fields['retail_list_items'] ?? null )
            ? $fields['retail_list_items']
            : array();

        $image_url = '';
        if ( ! empty( $fields['retail_image'] ) ) {
            $image_url = wp_get_attachment_image_url( $fields['retail_image'], 'full' );
        }
        $has_image = ! empty( $image_url );
        ?>
        <section class="section-retail">
            <div class="container-fluid">
                <div class="retail-grid<?php echo $has_image ? '' : ' retail-grid--no-image'; ?>">
                    <div class="retail-copy">
                        <?php if ( $heading ) : ?>
                            <h2 class="section-heading">
                                <?php echo esc_html( $heading ); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if ( $intro ) : ?>
                            <p class="section-lead">
                                <?php echo esc_html( $intro ); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ( $intro_second ) : ?>
                            <p class="section-lead">
                                <?php echo esc_html( $intro_second ); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ( ! empty( $list_items ) ) : ?>
                            <ul class="retail-list">
                                <?php foreach ( $list_items as $item ) :
                                    $text = $item['item_text'] ?? '';
                                    if ( ! $text ) {
                                        continue;
                                    }
                                    ?>
                                    <li><?php echo esc_html( $text ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <?php if ( $has_image ) : ?>
                        <figure class="retail-media">
                            <img
                                src="<?php echo esc_url( $image_url ); ?>"
                                alt="<?php echo esc_attr( $heading ?: 'Retail / Light Industrial illustration' ); ?>"
                                loading="lazy"
                                decoding="async"
                            />
                        </figure>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php
    } );

// Stands Block 
Block::make( __( 'Stands Grid', 'northgate' ) )
    ->add_fields( array(
        Field::make( 'complex', 'stands_items', __( 'Cards', 'northgate' ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'image', 'card_image', __( 'Card Image', 'northgate' ) )
                    ->set_value_type( 'url' ),

                Field::make( 'text', 'card_title', __( 'Title', 'northgate' ) ),

                Field::make( 'textarea', 'card_intro', __( 'Intro Text', 'northgate' ) )
                    ->set_rows( 3 ),

                Field::make( 'text', 'card_link', __( 'Link URL or Title', 'northgate' ) ),
            ) ),
    ) )
    ->set_description( __( 'Grid of stand/plan cards (image, title, intro, button)', 'northgate' ) )
    ->set_icon( 'screenoptions' )
    ->set_category( 'northgate-blocks' )
    ->set_render_callback( function( $fields, $attributes, $inner_blocks ) {

        $cards = is_array( $fields['stands_items'] ?? null )
            ? $fields['stands_items']
            : array();

        if ( empty( $cards ) ) {
            return;
        }
        ?>

        <section class="container-fluid">
            <div class="news-carousel">
                <?php foreach ( $cards as $card ) :

                    $img      = $card['card_image'] ?? '';
                    $title    = $card['card_title'] ?? '';
                    $intro    = $card['card_intro'] ?? '';
                    $raw_link = trim( $card['card_link'] ?? '' );

                    $href = '';

                    if ( $raw_link !== '' ) {
                        if ( preg_match( '#^https?://#i', $raw_link ) ) {
                            $href = $raw_link;

                        } else {
                            $slug = sanitize_title( $raw_link );
                            $href = home_url( '/' . $slug . '/' );
                        }
                    }
                    ?>

                    <article class="news-card">
                        <?php if ( $href ) : ?>
                            <a href="<?php echo esc_url( $href ); ?>" class="js-stand-link">
                        <?php else : ?>
                            <div class="js-stand-link">
                        <?php endif; ?>

                                <div class="news-thumb js-stand-image"
                                     style="<?php echo $img ? 'background-image:url(' . esc_url( $img ) . ');' : ''; ?>">
                                </div>

                                <div class="news-body">
                                    <?php if ( $title ) : ?>
                                        <h3 class="section-lead-news-heading js-stand-title">
                                            <?php echo esc_html( $title ); ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if ( $intro ) : ?>
                                        <p class="section-lead muted js-stand-intro">
                                            <?php echo esc_html( $intro ); ?>
                                        </p>
                                    <?php endif; ?>

                                    <p class="btn-secondary">VIEW PLANS</p>
                                </div>

                        <?php if ( $href ) : ?>
                            </a>
                        <?php else : ?>
                            </div>
                        <?php endif; ?>
                    </article>

                <?php endforeach; ?>
            </div>
        </section>

        <?php
    });
});


function zifa_website_partners_slider() {
	register_post_type( 'partners-slider',
		array(
			'labels' => array(
				'name' => __( 'Partners Slider' ),
				'singular_name' => __( 'Partners Slider' ),
				'add_new_item' => 'Add New Partners Slider',
				'add_new' => __('Add New Partners Slider'),
				'attributes' => __( 'Partners Slider Attributes', 'text_domain' ),
			),
			'public' => true,
            // 'hierarchical' => false, // Enables parent-child relationships
            // 'publicly_queryable' => true, // explicitly set if needed
            // 'has_archive'        => true,
            // 'show_in_rest'       => true, // Enables Gutenberg support
			'rewrite' => array(
				'slug' => 'partners-slider'
            ),
			'supports' => array( 
                'title',
                'thumbnail',
                // 'editor', // Content editor
                // 'page-attributes' // Page attributes allow parent assignment
            ), 
			'menu_position' => 5,
			'menu_icon' => __('dashicons-images-alt2')
		)
	);
}
add_action( 'init', 'zifa_website_partners_slider' );


// Front-end: dequeue global + block theme styles
add_action('wp_enqueue_scripts', function () {

    $handles = [
        'global-styles',           
        'wp-block-library-theme',  
        'classic-theme-styles',   
    
    ];
    foreach ($handles as $h) {
        wp_dequeue_style($h);
        wp_deregister_style($h);
    }
}, 100);

add_action('enqueue_block_editor_assets', function () {
    $handles = [
        'global-styles',
        'wp-block-library-theme',
        'classic-theme-styles',
    ];
    foreach ($handles as $h) {
        wp_dequeue_style($h);
        wp_deregister_style($h);
    }
}, 100);




add_action('admin_head', function () {
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || !in_array($screen->base, ['post','post-new'], true)) return;
    ?>
    <style>
        .interface-interface-skeleton__content,
        .edit-post-layout__content,
        .editor-styles-wrapper,
        .block-editor-writing-flow { background: #fff !important; }
    </style>
    <?php
});


// Simple breadcrumbs with pipes: Home | Section | Title
function ng_breadcrumbs() {
    if ( is_front_page() ) return; 
    $home_url = home_url('/');
    $news_url = 'http://localhost/north-gate/news/'; 

    echo '<nav class="ng-breadcrumbs" aria-label="Breadcrumb">'
        . '<a href="' . esc_url($home_url) . '">Home</a>'
        . ' <span class="sep">|</span> '
        . '<a href="' . esc_url($news_url) . '">News</a>'
        . '</nav>';
}

