<div class="modal_content modal-login radius">
    <div class="form_login">
        <h1 class="icon-sign-in">Login:</h1>
        <p>Olá, você precisa logar na sua conta para continuar!</p>
        <form action="<?= $router->route("auth.login"); ?>" class="app_form" method="post"
              enctype="multipart/form-data">
            <input type="hidden" name="redirect" value="<?= $redirect; ?>">
            <label>
                <span class="icon-envelope">E-mail</span>
                <input type="text" name="email" class="radius" placeholder="Seu e-mail de cadastro">
            </label>
            <label>
                <span class="icon-unlock-alt">Senha:</span>
                <input type="password" name="password" class="radius" placeholder="Sua senha">
            </label>

            <div class="app_form_actions">
                <button class="btn btn-green text-upper icon-check">Fazer Login
                    <span class="icon-notext icon-blink-smiley"></span></button>

                <div class="app_form_actions_links">
                    <span class="icon-times j_modal_close form_modal_back transition" title="Fechar">Fechar</span>
                </div>
            </div>
        </form>
    </div>
</div>