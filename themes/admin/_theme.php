<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?= $head; ?>

    <link rel="stylesheet" href="<?= asset("style.min.css", "admin"); ?>"/>
    <link rel="icon" type="image/png" href="<?= asset("/images/favicon.png", "admin"); ?>"/>
</head>
<body>

<div class="message_modal_box">
    <?= flash(); ?>
</div>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <div class="ajax_load_box_title">Aguarde, carregando...</div>
    </div>
</div>

<?php $url = filter_input(INPUT_GET, "route", FILTER_SANITIZE_STRIPPED); ?>
<?php $user = (new \Source\Models\User())->findById($_SESSION["user"]); ?>
<div class="dash dash_course">
    <div class="dash_nav">
        <div class="dash_nav_close">
            <span class="icon-notext icon-times transition j_dash_nav_close" title="Fechar Menu"></span>
        </div>
        <div class="dash_nav_user">
            <img src="<?= (!empty($user->photo) ? image($user->photo, 500, 500) : asset("images/avatar.jpg",
                "admin")); ?>" alt="[<?= "{$user->first_name} {$user->last_name}"; ?>]"
                 title="<?= "{$user->first_name} {$user->last_name}"; ?>" class="rounded">
            <h1><?= "{$user->first_name} {$user->last_name}"; ?></h1>
        </div>

        <ul class="dash_nav_ul">
            <li class="dash_nav_ul_li<?= $url == "/admin" ? " active" : ""; ?>">
                <a href="<?= site(); ?>/admin" title="Dashboard" class="transition dash_nav_ul_li_a">
                    Dashboard
                </a>
            </li>
            <li class="dash_nav_ul_li<?= $url == "/admin/introducao" ? " active" : ""; ?>">
                <a href="<?= $router->route("introduction.home"); ?>" title="Introdução"
                   class="transition dash_nav_ul_li_a">Introdução</a>
            </li>

            <?php if ($user->level >= 10): ?>
                <li class="dash_nav_ul_li">
                    <a href="<?= site("admin"); ?>" title="Configurações"
                       class="transition dash_nav_ul_li_a">Configurações</a>
                </li>
            <?php endif; ?>
            <li class="dash_nav_ul_li">
                <a href="<?= site(); ?>" title="Voltar para o site" class="transition dash_nav_ul_li_a">
                    Ver Site</a>
            </li>
        </ul>
    </div>

    <main class="dash_main">
        <?= $v->section("content"); ?>
    </main>
</div>

<script src="<?= site(); ?>/themes/_shared/scripts/tinymce/tinymce.min.js"></script>
<script src="<?= asset("scripts.min.js", "admin"); ?>"></script>
<?= $v->section("scripts"); ?>

</body>
</html>