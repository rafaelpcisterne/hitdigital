<?php $v->layout("web/_theme"); ?>

<div class="page">
    <h1>Ooops, erro <?= $error; ?></h1>
    <p>Desculpe por isso, caso o problema persista, por favor entre em contato conosco.</p>
    <p><a class="btn btn-blue icon-undo" href="<?= $router->route("web.home"); ?>"
          title="<?= SITE["name"]; ?>">VOLTAR!</a></p>
</div>