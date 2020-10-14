<?php

namespace Source\App\Admin;

use Source\App\Controller;
use Source\Models\User;
use Source\Support\Email;

class Auth extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function login(array $data): void
    {

        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $password = filter_var($data["password"], FILTER_DEFAULT);

        if (!$email || !$password) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-alert",
                "type" => "alert",
                "msgTitle" => "Opsss. Dados inválidos. ",
                "description" => "Por favor informe seu E-mail e Senha para acessar sua conta!"
            ]);
            return;
        }

        $user = (new User())->find("email = :e", "e={$email}")->fetch();
        if (!$user || !password_verify($password, $user->password)) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Opsss. Algo deu errado!",
                "description" => "E-mail ou senha informados não conferem!"
            ]);
            return;
        }

        if ($user->level <= 6) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Login não permitido!",
                "description" => "Você não tem permissão para acessar o painel de gerenciamento!"
            ]);
            return;
        }

        $_SESSION["user"] = $user->id;

        flash("icon-check", "success", "Login realizado com sucesso!",
            "Prontinho {$user->first_name}, login realizado com sucesso!");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("admin.home")
        ]);
    }

    public function forget(array $data): void
    {
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-alert",
                "type" => "alert",
                "msgTitle" => "Opsss. Algo deu errado!",
                "description" => "Informe o SEU E-MAIL para recuperar a senha!"
            ]);
            return;
        }

        $user = (new User())->find("email = :e", "e={$email}")->fetch();
        if (!$user) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Opsss. Algo deu errado",
                "description" => "O E-MAIL informado não está cadastrado no sistema!"
            ]);
            return;
        }

        if ($user->level <= 6) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Login não permitido!",
                "description" => "Você não tem permissão para acessar o painel de gerenciamento!"
            ]);
            return;
        }

        $user->forget = (md5(uniqid(rand(), true)));
        $user->save();

        $_SESSION["forget"] = $user->id;

        $email = new Email();
        $email->add(
            "Recupere sua senha | " . SITE["name"],
            $this->view->render("_shared/emails/recover", [
                "user" => $user,
                "link" => $this->router->route("login.reset", [
                    "email" => $user->email,
                    "forget" => $user->forget
                ])
            ]),
            "{$user->first_name} {$user->last_name}",
            $user->email
        )->send();

        flash("icon-check", "success", "Acesse seu e-mail para continuar!",
            "Enviamos um link de recuperação para o seu e-mail!");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("login.forget")
        ]);
    }

    /**
     * @param array $data
     */
    public function reset(array $data): void
    {
        if (empty($_SESSION["forget"]) || !$user = (new User())->findById($_SESSION["forget"])) {
            flash("icon-times", "error", "Opsss. Algo deu errado!", "Não foi possível recuperar, tente novamente!");
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("admin.forget")
            ]);
            return;
        }

        if (empty($data["password"]) || empty($data["password_re"])) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-alert",
                "type" => "alert",
                "msgTitle" => "Opsss. Algo deu errado",
                "description" => "Informe e repita sua nova senha!"
            ]);
            return;
        }

        if ($data["password"] != $data["password_re"]) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Opsss. Algo deu errado",
                "description" => "Você informou duas senhas diferentes!"
            ]);
            return;
        }

        if ($user->level <= 6) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Login não permitido!",
                "description" => "Você não tem permissão para acessar o painel de gerenciamento!"
            ]);
            return;
        }

        $user->password = $data["password"];
        $user->forget = null;

        if (!$user->save()) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Opsss. Algo deu errado!",
                "description" => $user->fail()->getMessage() . "!"
            ]);
            return;
        }

        unset($_SESSION["forget"]);

        flash("icon-check", "success", "Atualizada com sucesso!", "Sua senha foi atualizada com sucesso!");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("login.home")
        ]);
    }
}