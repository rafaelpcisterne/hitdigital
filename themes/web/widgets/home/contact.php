<?php $v->layout("web/_theme"); ?>

<section class="container content_home">
    <header class="content_home_header">
        <h1>Contato<span></span></h1>
    </header>

    <div class="content radius-medium">
        <form action="<?= $router->route("web.contact"); ?>" method="post" enctype="multipart/form-data" class="form">
            <label class="label_50">
                <input type="text" name="name" class="radius" placeholder="Nome*">
            </label>
            <label class="label_50">
                <input type="email" name="email" class="radius" placeholder="E-mail*">
            </label>
            <label>
                <textarea name="message" rows="10" class="radius"
                          placeholder="Mensagem*"></textarea>
            </label>
            <input type="hidden" name="action" value="send-contact">
            <button class="btn">Enviar</button>
        </form>
    </div>
</section>