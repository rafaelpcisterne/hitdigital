<?php $v->layout("admin/_theme-login"); ?>
<div class="main_content_box">
    <div class="login">
        <form class="form" action="<?= $router->route("auth.loginAdmin"); ?>" method="post" autocomplete="off">
            <div class="login_dev">
                <img src="<?= asset("/images/logo-dev.jpg", "admin"); ?>" alt="[RG Soluções Web]"
                     title="RG Soluções Web" class="rounded">
                <h1>Painel de Gerenciamento</h1>
            </div>

            <label>
                <span class="field">E-mail:</span>
                <input type="email" name="email" placeholder="Informe seu e-mail:"/>
            </label>
            <label>
                <span class="field">Senha:</span>
                <input type="password" name="password" placeholder="Informe sua senha:"/>
            </label>

            <div class="form_actions">
                <button class="btn btn-blue">Entrar</button>
                <a href="<?= $router->route("login.forget"); ?>" title="Recuperar Senha">Recuperar Senha</a>
            </div>
        </form>
    </div>
</div>