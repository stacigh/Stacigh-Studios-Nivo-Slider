<?php
/*
Plugin Name: JTNN Homepage Slideshow
Description: Adds a "Hero Banners" menu item that controls all banners for the homepage slideshow.
Author: Stacigh Studios
Author URI: http://www.stacighstudios.com
Version: 1.0
*/

/* -- Global Variables
------------------------------------------------- */
$jtnn_homepage_slideshow_version = 1.0;
$jtnn_homepage_slideshow_pluginURL = plugin_dir_url(__FILE__);

/* -- Styles & Scripts
------------------------------------------------- */
//include('includes/scripts.php'); // Controls all JS/CSS

/* -- CSS Overrides
------------------------------------------------- */
//include('includes/css-overrides.php'); // CSS overrides

/* -- Includes
------------------------------------------------- */

include('includes/display-functions.php'); // Functions
include('includes/admin-page.php'); // Settings page content & functions
include('includes/shortcode.php'); // Handles shortcode
//include('includes/taxonomy.php'); // Register Custom Taxonomy


/* -- Register Custom Taxonomy
_________________________________________________ */
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

	//register_taxonomy_for_object_type( 'jtnnhpss', 'ss_hero_banner' );

}

add_image_size( 'slideshow', 630, 354, true );


?>
