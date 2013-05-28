<?php
function jtnn_homepage_slideshow_codex () {
    ob_start();
    ?>
<h2>I can has info!</h2>
    <p>
        <em>I is your codex.</em>
        <br />
        <img src="http://placekitten.com/200/300" />
    </p>
    <?php
    $layout = ob_get_contents();
    ob_end_clean();
    return $layout;
}
?>
