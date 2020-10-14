<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?= $head; ?>

    <link rel="stylesheet" href="<?= asset("style.min.css"); ?>"/>
    <link rel="icon" type="image/png" href="https://www.hitdigital.com.br/favicon.ico"/>
</head>
<body>

<?php $url = filter_input(INPUT_GET, "route", FILTER_SANITIZE_STRIPPED); ?>

<div class="message_modal_box">
    <?= flash(); ?>
</div>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <div class="ajax_load_box_title">Aguarde, carregando...</div>
    </div>
</div>

<header class="container">
    <div class="main_header">
        <div class="main_header_logo">
            <h1 class="ds-none"><?= CONF_SITE_NAME; ?></h1>
            <div class="main_header_logo_link">
                <a href="<?= site(); ?>" title="<?= CONF_SITE_NAME; ?>">
                    <img src="https://www.hitdigital.com.br/css/images/logo-hit-marketing-digital.svg"
                         alt="[<?= CONF_SITE_NAME; ?>]" title="<?= CONF_SITE_NAME; ?>">
                </a>
            </div>

            <div class="main_header_nav_menu">
                <span class="j_nav_mobile transition radius icon-notext icon-bars"></span>
            </div>
        </div>

        <div class="main_header_nav">
            <nav>
                <h2 class="ds-none">Navegue pelo site e conheça nossos Serviços!</h2>
                <div class="main_header_nav_close">
                    <a href="<?= site(); ?>" title="Fechar Menu" class="j_nav_close transition">
                        <span class="icon-notext icon-times"></span>
                    </a>
                </div>
                <ul class="main_header_nav_ul">
                    <li>
                        <h3><a href="<?= site(); ?>" title="Introdução" class="transition radius">Introdução</a></h3>
                    </li>
                    <li>
                        <h3><a href="<?= site("contato"); ?>" title="Contato" class="transition radius">Contato</a></h3>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<main class="main_content">
    <?= $v->section("content"); ?>
</main>

<script src="<?= asset("scripts.min.js"); ?>"></script>
<?= $v->section("scripts"); ?>

</body>
</html>
