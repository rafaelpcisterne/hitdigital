<?php

namespace Source\App\Admin;

use Source\App\Controller;
use Source\Models\User;

/**
 * Class Introduction
 * @package Source\App\Admin
 */
class Introduction extends Controller
{
    /** @var User */
    protected $user;

    /**
     * Course constructor.
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
                "Você tentou acessar uma area restrito, você foi desconectado!");
            $this->router->redirect("web.login");
            return;
        }
    }

    /**
     * @param array|null $data
     */
    public function home(?array $data): void
    {
        $introduction = (new \Source\Models\Introduction())->find()->fetch();
        if (!empty($data) && $data["action"] == "ok") {
            if (empty($data["description"])) {
                echo $this->ajaxResponse("message", [
                    "icon" => "icon-alert",
                    "type" => "alert",
                    "msgTitle" => "Opsss. Algo deu errado!",
                    "description" => "Por favor, preencha a Introdução para atualizar!"
                ]);
                return;
            }

            if (!$introduction) {
                $introduction = new \Source\Models\Introduction();
                $introduction->description = $data["description"];
                $introduction->save();
            }else{
                $introduction->description = $data["description"];
                $introduction->save();
            }

            echo $this->ajaxResponse("message", [
                "icon" => "icon-check",
                "type" => "success",
                "msgTitle" => "Tudo Certo!",
                "description" => "A introdução foi atualizada com sucesso"
            ]);
            return;
        }


        $head = $this->seo->optimize(
            "Introdução | Painel de Gerenciamento RG Control!",
            "Sistema de gestão de conteúdo profissional!",
            $this->router->route("introduction.home"),
            asset("images/default.jpg", "admin"),
            false
        )->render();

        echo $this->view->render("admin/widgets/introduction/home", [
            "head" => $head,
            "introduction"=> !empty($introduction) ? $introduction : null
        ]);
    }
}