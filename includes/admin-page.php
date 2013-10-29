<?php

include ('settings-codex.php');

class ss_slideshow_settings {

    function settings_page () {
        ob_start();
        ?>
<div class="wrap">

    <h2>I is your settings!</h2>
    <p>I is in a paragraph tag!
        <br />
        <img src="http://placekitten.com/300/150" />
    </p>
    <p>Me TOO!
        <br />
        <img src="http://placekitten.com/300/200" />
    </p>
    <div class="tab codex">
        <?php echo ss_slideshow_codex(); ?>
    </div>

</div>
        <?php
        $layout = ob_get_contents();
        ob_end_clean();
        echo $layout;
    }

    function add_settings_page() {
        add_submenu_page('edit.php?post_type=ss_hero_banner',
                         'Stacigh Studios Nivo Slider',
                         'Settings',
                         'manage_options',
                         'ss_slideshow', array('ss_slideshow_settings', 'settings_page'));
    }

}
add_action( 'admin_menu', array( 'ss_slideshow_settings', 'add_settings_page' ) );
?>
