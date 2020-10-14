<?php

namespace Source\App\Admin;

use Source\App\Controller;
use Source\Models\Access;
use Source\Models\Online;
use Source\Models\User;

/**
 * Class Admin
 * @package Source\App\Admin
 */
class Admin extends Controller
{
    /** @var User */
    protected $user;

    /**
     * Admin constructor.
     * @param $router
     */
    public function __construct($router)
    {
        parent::__construct($router);

        if (empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
            unset($_SESSION["user"]);
            flash("error", "Acesso negado. Por favor, efetue o login para acessar o Painel de Gerenciamento!");
            $this->router->redirect("login.home");
        }

        if ($this->user->level < 6) {
            unset($_SESSION["user"]);
            flash("icon-times", "error", "Acesso não permitido!",
                "Você tentou acessar uma area restrita, você foi desconectado!");
            $this->router->redirect("web.login");
            return;
        }
    }

    /**
     *
     */
    public function home(): void
    {

        $head = $this->seo->optimize(
            "Painel de Gerenciamento | RG Control!",
            "Sistema de gestão de conteúdo profissional!",
            $this->router->route("admin.home"),
            asset("images/default.jpg", "admin"),
            false
        )->render();

        echo $this->view->render("admin/widgets/home/home", [
            "head" => $head
        ]);
    }

    /**
     * @param $data
     */
    public function error($data): void
    {
        $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);
        $head = $this->seo->optimize(
            "Ooops {$error} | " . SITE["name"],
            SITE["desc"],
            $this->router->route("web.error"),
            asset("images/default.jpg", "admin"),
            false
        )->render();

        echo $this->view->render("web/error", [
            "head" => $head,
            "error" => $error
        ]);
    }

    public function logoff(): void
    {
        unset($_SESSION["user"]);
        flash("icon-info", "info", "Desconectado com sucesso!",
            "Você desconectou com sucesso, volte logo {$this->user->first_name}!");
        $this->router->redirect("login.home");
    }
}