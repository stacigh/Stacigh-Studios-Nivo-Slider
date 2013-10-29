<?php

/* -- Create "Hero Banners" custom post type
------------------------------------------------- */
add_action( 'init', 'register_post_type_hero_banner' ); //Must come before the function
function register_post_type_hero_banner() {

	register_post_type( 'ss_hero_banner',
		array(
			'labels' => array(
				'name' => __( 'Slideshow' ),
				'singular_name' => __( 'Slideshow' ),
				'add_new_item' => __( 'Add New Banner', 'image' ),
				'edit_item' => __( 'Edit Banner' ),
				'view_item' => __( 'View Banner' ),
				'search_items' => __( 'Search Banners' ),
				'not_found' => __( 'No banners found' ),
				'not_found_in_trash' => __( 'No banners found in Trash' ),
			),
		'public' => true,
		'has_archive' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'menu_position' => 20,
		'supports' => array('title','thumbnail'),
		'register_meta_box_cb' => 'add_banners_metaboxes',
		)
	);
}

/* -- Add Meta Boxes
------------------------------------------------- */
add_action ( 'add_meta_boxes', 'add_banners_metaboxes' );
function add_banners_metaboxes(){
	add_meta_box('ss_hero_banner_link', 'Banner Link', 'ss_hero_banner_link', 'ss_hero_banner', 'normal', 'default' );
	add_meta_box('ss_hero_banner_caption', 'Banner Caption', 'ss_hero_banner_caption', 'ss_hero_banner', 'normal', 'default');
	add_meta_box('ss_hero_banner_cat_type', 'Banner Type', 'ss_hero_banner_cat_type', 'ss_hero_banner', 'normal', 'default');
}

/* -- Hero Banner Link Meta Box
------------------------------------------------- */
function ss_hero_banner_link(){
	global $post;

	// Noncename needed to verify where the data originated
	wp_nonce_field( 'ss_hps_nonce', 'ss_hps_nonce' );

	// Get the url of the data if it's already been entered
	$url = get_post_meta($post->ID, '_url', true);

	// Echo the field
	echo '<strong>Where would you like the banner to link?</strong><input type="text" name="_url" value="' . $url . '" class="widefat" placeholder="http://"/>';
}

/* -- Hero Banner Caption Meta Box
------------------------------------------------- */
function ss_hero_banner_caption(){
	global $post;

	// Get the caption of the data if it's already been entered
	$caption = get_post_meta($post->ID, '_caption', true);

	// Echo the field
	echo '<strong>Banner Caption</strong><textarea name="_caption" class="widefat">' . $caption . '</textarea>';
}

/* -- Hero Banner Category Meta Box
------------------------------------------------- */
function ss_hero_banner_cat_type(){
	global $post;

	// Get the image of the data if it's already been entered
	//$cat_type = get_the_term_list($post->ID, 'ssnivoslider' );
    if ( has_term('monthly', 'ssnivoslider', $post->ID) ) {
        $cat_type = 'monthly';
    } else {
        $cat_type = 'rolling';
    }
    ?>
	<strong>Is this banner a monthly promotion?</strong><br />
	<input type="radio" name="_cat_type" value="monthly"<?php checked( 'monthly' == $cat_type ); ?>>Yes (Monthly)<br>
	<input type="radio" name="_cat_type" value="rolling"<?php checked( 'rolling' == $cat_type ); ?>>No (Continuous)
    <?php
}

/* -- Save the metadata
------------------------------------------------- */
// http://wptheming.com/2010/08/custom-metabox-for-post-type/
// http://wp.tutsplus.com/tutorials/plugins/a-guide-to-wordpress-custom-post-types-creation-display-and-meta-boxes/
// http://new2wp.com/noob/create-metabox-custom-post-types/
// http://codex.wordpress.org/Function_Reference/register_post_type
// http://codex.wordpress.org/Post_Types
// http://codex.wordpress.org/Function_Reference/add_meta_box
add_action( 'save_post', 'ss_slideshow_post_save' );
function ss_slideshow_post_save( $post_id ) {

/*
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;
*/
	if ( empty($_POST) || !wp_verify_nonce( $_POST['ss_hps_nonce'], 'ss_hps_nonce' ) )
	return;
/*
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}
*/

	$returned_url = $_POST['_url'];
	update_post_meta( $post_id, '_url', $returned_url );
	$returned_caption = $_POST['_caption'];
	update_post_meta( $post_id, '_caption', $returned_caption );
    $returned_cat_type = $_POST['_cat_type'];
	wp_set_object_terms( $post_id, $returned_cat_type, 'ssnivoslider', false );
}

?>
