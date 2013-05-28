<?php

// A quick check to prevent running the include by itself
if ('shortcode.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('<h1>Direct File Access Prohibited</h1>');

add_action( 'init', 'jtnn_homepage_slideshow_taxonomy', 0);

function jtnn_homepage_slideshow_taxonomy() {

    $labels = array(
		'name'              => 'JTNN Slideshow',
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => false,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
	);

	register_taxonomy( 'jtnnhpss', 'ss_hero_banner', $args );

	register_taxonomy_for_object_type( 'jtnnhpss', 'ss_hero_banner' );

}



?>
