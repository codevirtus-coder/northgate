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





/* -----------------------------------------------------------
 * 2) Assets (Bootstrap, Icons, Google Font, Theme CSS, Bootstrap JS)
 * ----------------------------------------------------------- */
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . './assets/css/bootstrap.min.css', [], '1.5.0');
	wp_enqueue_style('styles-css', get_template_directory_uri() . './assets/css/style.min.css', [], '1.5.0');
	// JS
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', [], null, true);
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
add_action('wp_enqueue_scripts', function () {
	$handle = 'nav-card-hover';
	$path   = get_stylesheet_directory() . '/assets/js/nav-card-hover.js';

	wp_enqueue_script(
		$handle,
		get_stylesheet_directory_uri() . '/assets/js/nav-card-hover.js',
		[],
		file_exists($path) ? filemtime($path) : false,
		true
	);

	$preview_data = [
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
	];

	wp_localize_script($handle, 'navPreviewData', $preview_data);
}, 25);





/* -----------------------------------------------------------
 * 7) Carbon Fields meta/option containers
 * ----------------------------------------------------------- */
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

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

	// Designs
    Container::make( 'post_meta', 'Architectural DESIGNS' )
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
			] ),
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
});


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

