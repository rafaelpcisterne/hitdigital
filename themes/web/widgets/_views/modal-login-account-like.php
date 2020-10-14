<div class="modal_content modal-login-account-like radius">
    <div class="form_login-like">
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
                    <span class="icon-next form_modal_account j_modal_create_account-like transition"
                          title="Criar conta">Ainda não tenho conta!</span>
                </div>
            </div>
        </form>
    </div>

    <div class="form_create_account-like" style="display: none;">
        <h1 class="icon-user-plus">Cadastre-se:</h1>
        <p>Faça seu cadastro, é rapidinho e você terá mais facilidade na próxima vez!
            <span class="icon-notext icon-blink-smiley"></span></p>
        <form action="<?= $router->route("auth.register"); ?>" class="app_form" method="post"
              enctype="multipart/form-data">
            <input type="hidden" name="redirect" value="<?= $redirect; ?>">
            <input type="hidden" name="action" value="<?= $action; ?>">
            <label>
                <span class="icon-user">Nome:</span>
                <input type="text" name="first_name" class="radius" placeholder="Seu nome">
            </label>
            <label>
                <span class="icon-user-plus">Sobrenome:</span>
                <input type="text" name="last_name" class="radius" placeholder="Seu sobrenome">
            </label>
            <label>
                <span class="icon-envelope">E-mail:</span>
                <input type="text" name="email" class="radius" placeholder="Seu melhor e-mail">
            </label>
            <label>
                <span class="icon-unlock-alt">Senha:</span>
                <input type="password" name="password" class="radius" placeholder="Sua senha">
            </label>

            <div class="app_form_actions">
                <button class="btn btn-green text-upper icon-check">Continuar
                    <span class="icon-notext icon-blink-smiley"></span></button>

                <div class="app_form_actions_links">
                    <span class="icon-times j_modal_close form_modal_back transition" title="Fechar">Fechar</span>
                    <span class="icon-sign-in form_modal_account j_modal_login-like transition"
                          title="Fazer login">Fazer Login!</span>
                </div>
            </div>
        </form>
    </div>
</div>