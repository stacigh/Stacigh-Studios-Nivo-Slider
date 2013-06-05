<?php

// A quick check to prevent running the include by itself
if ('shortcode.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('<h1>Direct File Access Prohibited</h1>');

// Main shortcode function
function jtnn_homepage_slideshow_shortcode() {

    global $jtnn_homepage_slideshow_pluginURL;

    $posts_needed = 6;
    $currentMonth = (int)date('m');

    $args = array(  'post_type' => 'ss_hero_banner',
                    'post_status' => 'publish',
                    'posts_per_page' => $posts_needed ,
                    'order' => 'DESC',
                    'order_by' => 'date',
                    'jtnnhpss' => 'monthly',
                    'monthnum' => $currentMonth,

                  );

    $loop = new WP_Query( $args );
    $layout_loop = '<div class="slider-wrapper theme-default"><div id="slider" class="nivoSlider">';


    // First loop for monthly posts

    while ( $loop->have_posts() ) : $loop->the_post();

        $currentPostID = get_the_ID();
	$postMeta = get_post_meta($currentPostID);
	$post_URL = $postMeta['_url'][0];

	    if ( has_post_thumbnail() ) {
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($currentPostID), 'slideshow' );
            $image = $thumb['0'];
            $href = '';
            
            if ($post_URL != '' AND $post_URL != null) {
	            $href = " href='".$post_URL."'";
	        }            
	        ob_start();
	        ?>
    <a<?php echo $href; ?>>
    <img src="<?php echo $image ?>" data-thumb="<?php echo $image ?>" title="<?php echo $postMeta['_caption'][0]; ?>" alt="" />
    </a>
        <?php

        $layout_loop .= ob_get_contents();
        ob_end_clean();
        $posts_needed = $posts_needed-1;
        }

    endwhile;

    // Second loop for rolling promotions
    if ($posts_needed > 0) {
        $args2 = array(  'post_type' => 'ss_hero_banner',
                        'post_status' => 'publish',
                        'posts_per_page' => $posts_needed ,
                        'order' => 'DESC',
                        'order_by' => 'date',
                        'jtnnhpss' => 'rolling');

        $loop = new WP_Query( $args2 );

        while ( $loop->have_posts() ) : $loop->the_post();

            $currentPostID = get_the_ID();
	    $postMeta = get_post_meta($currentPostID);
	    $post_URL = $postMeta['_url'][0];

	        if ( has_post_thumbnail() ) {
	        	
	       	    $href = '';
            
            	    if ($post_URL != '' AND $post_URL != null) {
	                $href = " href='".$post_URL."'";
	            }
	        	
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($currentPostID), 'slideshow' );
                $image = $thumb['0'];
	            ob_start();
	            ?>
        <a<?php echo $href; ?>>
        <img src="<?php echo $image ?>" data-thumb="<?php echo $image ?>" title="<?php echo $postMeta['_caption'][0]; ?>" alt="" />
        </a>
            <?php
            $posts_needed = $posts_needed-1;
            }

            $layout_loop .= ob_get_contents();
            ob_end_clean();
        endwhile;
    }
    $layout_loop .= "</div></div>";


    ob_start();
    ?>


<!-- <script type="text/javascript" src="<?php echo $jtnn_homepage_slideshow_pluginURL . "jquery-1.9.0.min.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo $jtnn_homepage_slideshow_pluginURL . "jquery.nivo.slider.js"; ?>"></script>-->
    <script type="text/javascript">
    (function($) {})( jQuery );

    jQuery(window).load(function() {
	    jQuery('#slider').nivoSlider({
	        effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
	        //animSpeed: 500, // Slide transition speed
	        pauseTime: 10000, // How long each slide will show
	        startSlide: 0, // Set starting Slide (0 index)
	        directionNav: false, // Next & Prev navigation
	        controlNav: true, // 1,2,3... navigation
	        controlNavThumbs: false, // Use thumbnails for Control Nav
	        pauseOnHover: true, // Stop animation while hovering
	        manualAdvance: false, // Force manual transitions
	        prevText: 'Prev', // Prev directionNav text
	        nextText: 'Next', // Next directionNav text
	        randomStart: false, // Start on a random slide
	        beforeChange: function(){}, // Triggers before a slide transition
	        afterChange: function(){}, // Triggers after a slide transition
	        slideshowEnd: function(){}, // Triggers after all slides have been shown
	        lastSlide: function(){}, // Triggers when last slide is shown
	        afterLoad: function(){} // Triggers when slider has loaded
	    });
	});

    </script>
<?php
    $layout = $layout_loop.ob_get_contents();
    ob_end_clean();
    return $layout;
}

add_shortcode( 'jtnn_homepage_slideshow', 'jtnn_homepage_slideshow_shortcode');

// Enqueue Styles related to slideshow
function jtnn_homepage_slideshow_css () {

    global $jtnn_homepage_slideshow_pluginURL;

    wp_enqueue_style('jtnn_homepage_slideshow_css', $jtnn_homepage_slideshow_pluginURL . "css/nivo-slider.css", false );
}

add_action( 'wp_enqueue_scripts', 'jtnn_homepage_slideshow_css' );

// Enqueue Scripts related to slideshow
function jtnn_homepage_slideshow_js () {

    global $jtnn_homepage_slideshow_pluginURL;

    //wp_enqueue_script('jquery');
    wp_enqueue_script('jtnn_nivoslider', $jtnn_homepage_slideshow_pluginURL . 'scripts/jquery.nivo.slider.js', array('jquery'), null);
}

add_action( 'wp_enqueue_scripts', 'jtnn_homepage_slideshow_js' );
?>
