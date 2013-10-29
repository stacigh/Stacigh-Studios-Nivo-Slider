<?php
/*
Plugin Name: Stacigh Studios Nivo Slider
Description: Adds a "Hero Banners" menu item that controls all banners for the homepage slideshow.
Author: Stacigh Studios
Author URI: http://www.stacighstudios.com
Version: 1.0
*/

/* -- Global Variables
------------------------------------------------- */
$ss_slideshow_version = 1.0;
$ss_slideshow_pluginURL = plugin_dir_url(__FILE__);

/* -- Styles & Scripts
------------------------------------------------- */
//include('includes/scripts.php'); // Controls all JS/CSS

/* -- CSS Overrides
------------------------------------------------- */
//include('includes/css-overrides.php'); // CSS overrides

/* -- Includes
------------------------------------------------- */

include('includes/display-functions.php'); // Functions
include('includes/shortcode.php'); // Handles shortcode


/* -- Register Custom Taxonomy
_________________________________________________ */
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

	//register_taxonomy_for_object_type( 'ssnivoslider', 'ss_hero_banner' );

}

add_image_size( 'slideshow', 630, 354, true );


?>
