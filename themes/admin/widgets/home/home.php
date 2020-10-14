<?php $v->layout("admin/_theme"); ?>
<?php $url = filter_input(INPUT_GET, "route", FILTER_SANITIZE_STRIPPED); ?>

<header class="dash_main_header">
    <span class="icon-bars icon-notext dash_main_header_menu radius transition"></span>
    <h2 class="dash_main_header_view">
        <a href="<?= site(); ?>/admin" title="Dashboard" class="transition">Dashboard</a>
    </h2>
    <?php $v->insert("admin/widgets/_views/notify-logoff"); ?>
</header>

<div class="dash_main_content">

</div>