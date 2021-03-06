<?php

// A quick check to prevent running the include by itself
if ('shortcode.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('<h1>Direct File Access Prohibited</h1>');

add_action( 'init', 'ss_slideshow_taxonomy', 0);

function ss_slideshow_taxonomy() {

    $labels = array(
		'name'              => 'SS Nivo Slider',
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

	register_taxonomy( 'ssnivoslider', 'ss_hero_banner', $args );

	register_taxonomy_for_object_type( 'ssnivoslider', 'ss_hero_banner' );

}



?>
