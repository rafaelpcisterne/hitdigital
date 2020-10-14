<?php $v->layout("admin/_theme-login"); ?>
<div class="main_content_box">
    <div class="login">
        <form class="form" name="reset" action="<?= $router->route("auth.resetAdmin"); ?>" method="post"
              autocomplete="off">
            <div class="login_dev">
                <img src="<?= asset("/images/logo-dev.jpg", "admin"); ?>" alt="[RG Soluções Web]"
                     title="RG Soluções Web" class="rounded">
                <h1>Recuperar Senha</h1>
            </div>
            <label>
                <span class="field icon-unlock-alt">Nova Senha:</span>
                <input value="" type="password" name="password" placeholder="Cadastre uma nova senha:"/>
            </label>

            <label>
                <span class="field icon-unlock-alt">Confirmação:</span>
                <input value="" type="password" name="password_re" placeholder="Repita sua nova senha:"/>
            </label>

            <div class="form_actions">
                <button class="btn btn-green btn-full icon-check">Atualizar Minha Senha</button>
            </div>
        </form>

        <div class="form_register_action">
            <p>Você também pode:</p>
            <a href="<?= $router->route("login.home"); ?>" class="btn btn-blue icon-undo">Voltar ao Login</a>
        </div>
    </div>
</div>