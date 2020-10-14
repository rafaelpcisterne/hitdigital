<?php $v->layout("web/_theme"); ?>

<section class="container content_home">
    <header class="content_home_header">
        <h1>Introdução<span></span></h1>
    </header>

    <div class="htmlchars content radius-medium">
        <?php if ($introduction): ?>
            <?= $introduction->description; ?>
        <?php else:?>
            <div class="message_register info text-upper radius text-center">Nenhuma introdução foi adicionada até o momento!</div>
        <?php endif; ?>
    </div>
</section>