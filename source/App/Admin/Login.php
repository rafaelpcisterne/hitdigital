<?php

namespace Source\App\Admin;

use Source\App\Controller;
use Source\Models\User;

class Login extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function home(): void
    {
        if (!empty($_SESSION["user"])) {
            $user = (new User())->findById($_SESSION["user"]);
            if ($user->level < 6) {
                unset($_SESSION["user"]);
                flash("icon-times", "error", "Acesso não permitido!",
                    "Você tentou acessar uma area restrito, você foi desconectado!");
                echo $this->ajaxResponse("redirect", [
                    "url" => $this->router->route("web.login")
                ]);
            }
            $this->router->redirect("admin.home");
        }

        $head = $this->seo->optimize(
            "Faça login para acessar o Painel de Gerenciamento | RG Control ",
            "Sistema de gestão de conteúdo profissional!",
            $this->router->route("login.home"),
            asset("images/default.jpg", "admin"),
            false
        )->render();

        echo $this->view->render("admin/widgets/login/home", [
            "head" => $head
        ]);
    }

    /**
     *
     */
    public function forget(): void
    {
        if (!empty($_SESSION["user"])) {
            $user = (new User())->findById($_SESSION["user"]);
            if ($user->level < 6) {
                unset($_SESSION["user"]);
                flash("icon-times", "error", "Acesso não permitido!",
                    "Você tentou acessar uma area restrito, você foi desconectado!");
                echo $this->ajaxResponse("redirect", [
                    "url" => $this->router->route("web.login")
                ]);
            }
            $this->router->redirect("admin.home");
        }

        $head = $this->seo->optimize(
            "Recupere sua senha | RG Control",
            SITE["desc"],
            $this->router->route("login.forget"),
            asset("images/default.jpg", "admin"),
            false
        )->render();

        echo $this->view->render("admin/widgets/login/forget", [
            "head" => $head
        ]);
    }

    /**
     * @param array $data
     */
    public function reset(array $data): void
    {
        if (!empty($_SESSION["user"])) {
            $user = (new User())->findById($_SESSION["user"]);
            if ($user->level < 6) {
                unset($_SESSION["user"]);
                flash("icon-times", "error", "Acesso não permitido!",
                    "Você tentou acessar uma area restrito, você foi desconectado!");
                echo $this->ajaxResponse("redirect", [
                    "url" => $this->router->route("web.login")
                ]);
            }
            $this->router->redirect("admin.home");
        }

        if (empty($_SESSION["forget"])) {
            flash("icon-alert", "info", "Opsss. Algo deu errado!", "Informe seu E-MAIL para recuperar a senha!");
            $this->router->redirect("login.forget");
        }

        $errForget = "Não foi possível recuperar, tente novamente!";

        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $forget = filter_var($data["forget"], FILTER_DEFAULT);

        if (!$email || !$forget) {
            flash("icon-times", "error", "Opsss. Algo deu errado!", $errForget);
            $this->router->redirect("login.forget");
        }

        $user = (new User())->find("email = :e AND forget = :f AND level >= 6",
            "e={$email}&f={$forget}")->fetch();
        if (!$user) {
            flash("icon-times", "error", "Opsss. Algo deu errado!", $errForget);
            $this->router->redirect("login.forget");
        }

        $head = $this->seo->optimize(
            "Crie sua nova senha | RG Control",
            SITE["desc"],
            $this->router->route("login.reset"),
            asset("images/default.jpg", "admin"),
            false
        )->render();

        echo $this->view->render("admin/widgets/login/reset", [
            "head" => $head
        ]);
    }
}