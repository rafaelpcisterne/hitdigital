<?php

namespace Source\App\Web;

use Source\App\Controller;
use Source\Models\User;
use Source\Support\Email;

/**
 * Class Auth
 * @package Source\App\Web
 */
class Auth extends Controller
{
    /**
     * Auth constructor.
     * @param $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * @param array $data
     */
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

        $_SESSION["user"] = $user->id;

        if (!empty($data["redirect"])) {
            flash("icon-check", "success", "Login realizado com sucesso!",
                "Prontinho {$user->first_name}, conectado com sucesso!");
            echo $this->ajaxResponse("reload", ["true" => 1]);
            return;
        }

        flash("icon-check", "success", "Login realizado com sucesso!",
            "Prontinho {$user->first_name}, conectado com sucesso!");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("campus.home")
        ]);
    }

    /**
     * @param array $data
     */
    public function register(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Opsss. Algo deu errado",
                "description" => "Preencha todos os campos para se cadastrar!"
            ]);
            return;
        }

        $user = new User();
        $user->first_name = $data["first_name"];
        $user->last_name = $data["last_name"];
        $user->email = $data["email"];
        $user->password = $data["password"];
        $user->level = 1;
        $user->confirmation = 0;
        $user->code_confirm = (md5(uniqid(rand(), true)));

        if (!$user->save()) {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Opsss. Algo deu errado!",
                "description" => "{$user->fail()->getMessage()}!"
            ]);
            return;
        }

        $_SESSION["user"] = $user->id;

        //download material
        if (!empty($data["redirect"]) && !empty($data["action"]) && $data["action"] == "download-material") {
            $email = new Email();
            $email->add(
                "Conta Criada com Sucesso | " . SITE["name"],
                $this->view->render("_shared/emails/register-download", [
                    "user" => $user,
                    "link" => $this->router->route("auth.confirm", [
                        "email" => $user->email,
                        "code" => $user->code_confirm
                    ])
                ]),
                "{$user->first_name} {$user->last_name}",
                $user->email
            )->send();

            flash("icon-check", "success", "Conta criada com sucesso!",
                "Prontinho {$user->first_name}, acesse seu e-mail e confirme seu cadastro clicando no link enviado!");
            echo $this->ajaxResponse("reload", ["true" => 1]);
            return;
        }

        //comment like
        if (!empty($data["redirect"]) && !empty($data["action"]) && $data["action"] == "comment-like") {
            $email = new Email();
            $email->add(
                "Conta Criada com Sucesso | " . SITE["name"],
                $this->view->render("_shared/emails/register-like", [
                    "user" => $user,
                    "link" => $this->router->route("auth.confirm", [
                        "email" => $user->email,
                        "code" => $user->code_confirm
                    ])
                ]),
                "{$user->first_name} {$user->last_name}",
                $user->email
            )->send();

            flash("icon-check", "success", "Conta criada com sucesso!",
                "Prontinho {$user->first_name}, acesse seu e-mail e confirme seu cadastro clicando no link enviado!");
            echo $this->ajaxResponse("reload", ["true" => 1]);
            return;
        }

        //course free
        if (!empty($data["redirect"]) && !empty($data["action"]) && $data["action"] == "course-free") {
            $email = new Email();
            $email->add(
                "Conta Criada com Sucesso | " . SITE["name"],
                $this->view->render("_shared/emails/register-course-free", [
                    "user" => $user,
                    "link" => $this->router->route("auth.confirm", [
                        "email" => $user->email,
                        "code" => $user->code_confirm
                    ])
                ]),
                "{$user->first_name} {$user->last_name}",
                $user->email
            )->send();

            flash("icon-check", "success", "Conta criada com sucesso!",
                "Prontinho {$user->first_name}, acesse seu e-mail e confirme seu cadastro clicando no link enviado!");
            echo $this->ajaxResponse("reload", ["true" => 1]);
            return;
        }

        $email = new Email();
        $email->add(
            "Conta Criada com Sucesso | " . SITE["name"],
            $this->view->render("_shared/emails/register-confirm", [
                "user" => $user,
                "link" => $this->router->route("auth.confirm", [
                    "email" => $user->email,
                    "code" => $user->code_confirm
                ])
            ]),
            "{$user->first_name} {$user->last_name}",
            $user->email
        )->send();

        flash("icon-check", "success", "Conta criada com sucesso!",
            "Prontinho {$user->first_name}, acesse seu e-mail e confirme seu cadastro clicando no link enviado!");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("campus.home")
        ]);
    }

    /**
     * @param array $data
     */
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

        $user->forget = (md5(uniqid(rand(), true)));
        $user->save();

        $_SESSION["forget"] = $user->id;

        $email = new Email();
        $email->add(
            "Recupere sua senha | " . SITE["name"],
            $this->view->render("_shared/emails/recover", [
                "user" => $user,
                "link" => $this->router->route("web.reset", [
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
            "url" => $this->router->route("web.forget")
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
                "url" => $this->router->route("web.forget")
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
            "url" => $this->router->route("web.login")
        ]);
    }

    /**
     * CONFIRMATION REGISTER MESSAGE
     * @param array $data
     */
    public function confirm(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $user = (new User)->find("email = :e AND code_confirm = :c",
            "e={$data["email"]}&c={$data["code"]}");
        if (!$user->count()) {
            flash("icon-times", "error", "Opsss. Algo deu errado!",
                "Ocorreu um erro inesperado ao confirmar seu cadastro. Tente novamente!");
            redirect($this->router->route("web.home"));
            return;
        }

        $user = $user->fetch();
        $user->confirmation = 1;
        $user->code_confirm = null;
        $user->save();

        flash("icon-check", "success", "Tudo certo {$user->first_name}!",
            "Conta confirmada com sucesso, agora ficou fácil para interagir conosco! <span class='icon-notext icon-blink-smiley'></span>");
        redirect($this->router->route("web.home"));
        return;
    }
}