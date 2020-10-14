<?php $v->layout("admin/_theme-login"); ?>
<div class="main_content_box">
    <div class="login">
        <form class="form" action="<?= $router->route("auth.forgetAdmin"); ?>" method="post" autocomplete="off">
            <div class="login_dev">
                <img src="<?= asset("/images/logo-dev.jpg", "admin"); ?>" alt="[RG Soluções Web]"
                     title="RG Soluções Web" class="rounded">
                <h1>Recuperar Senha</h1>
            </div>
            <label>
                <span class="field icon-envelope">E-mail:</span>
                <input value="" type="email" name="email" placeholder="Informe seu e-mail:"/>
            </label>

            <div class="form_actions">
                <button class="btn btn-green btn-full icon-unlock-alt">Recuperar Minha Senha</button>
            </div>
        </form>

        <div class="form_register_action">
            <p>Você também pode:</p>
            <a href="<?= $router->route("login.home"); ?>" class="btn btn-blue icon-undo">Voltar ao Login</a>
        </div>
    </div>
</div>
