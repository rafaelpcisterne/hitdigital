<?php

/**
 * CSS
 */
$minCSS = new \MatthiasMullie\Minify\CSS();
$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/boot.css");
$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/button.css");
$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/form.css");
$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/load.css");
$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/message.css");
$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/message.css");
//$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/owl.carousel.min.css");
//$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/owl.theme.default.min.css");
$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/styles.css");
//$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/swiper.min.css");
//$minCSS->add(dirname(__DIR__, 3) . "/themes/_shared/styles/jquery-ui.css");
$minCSS->add(dirname(__DIR__, 3) . "/themes/web/assets/css/style.css");
$minCSS->minify(dirname(__DIR__, 3) . "/themes/web/assets/style.min.css");

/**
 * JS
 */
$minJS = new \MatthiasMullie\Minify\JS();
$minJS->add(dirname(__DIR__, 3) . "/themes/_shared/scripts/jquery.js");
$minJS->add(dirname(__DIR__, 3) . "/themes/_shared/scripts/jquery-ui.js");
$minJS->add(dirname(__DIR__, 3) . "/themes/_shared/scripts/jquery.form.js");
//$minJS->add(dirname(__DIR__, 3) . "/themes/_shared/scripts/owl.carousel.min.js");
//$minJS->add(dirname(__DIR__, 3) . "/themes/_shared/scripts/swiper.min.js");
$minJS->add(dirname(__DIR__, 3) . "/themes/_shared/scripts/form.js");
$minJS->add(dirname(__DIR__, 3) . "/themes/web/assets/js/scripts.js");
$minJS->minify(dirname(__DIR__, 3) . "/themes/web/assets/scripts.min.js");