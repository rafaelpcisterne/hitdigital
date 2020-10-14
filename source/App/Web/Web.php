<?php

namespace Source\App\Web;

use Source\App\Controller;
use Source\Models\Email;
use Source\Models\Introduction;

/**
 * Class Web
 * @package Source\App\Web
 */
class Web extends Controller
{
    /**
     * Web constructor.
     * @param $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     *
     */
    public function home(): void
    {
        $introduction = (new Introduction())->find()->fetch();

        $head = $this->seo->optimize(
            "Introdução | " . SITE["name"],
            SITE["desc"],
            $this->router->route("web.home"),
            asset("images/default.jpg")
        )->render();

        echo $this->view->render("web/widgets/home/home", [
            "head" => $head,
            "introduction" => !empty($introduction) ? $introduction : null
        ]);
    }

    /**
     * @param array $data
     */
    public function contact(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if (!empty($data["action"]) && $data["action"] != "send-contact") {
            echo $this->ajaxResponse("message", [
                "icon" => "icon-times",
                "type" => "error",
                "msgTitle" => "Opsss. Algo deu errado!",
                "description" => "Por favor, atualize a página e tente novamente!"
            ]);
            return;
        }

        if (!empty($data["action"]) && $data["action"] == "send-contact") {
            if (in_array("", $data)) {
                echo $this->ajaxResponse("message", [
                    "icon" => "icon-alert",
                    "type" => "alert",
                    "msgTitle" => "Opsss. Algo deu errado!",
                    "description" => "Por favor, preencha todos os campos para enviar a mensagem!"
                ]);
                return;
            }
            if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
                echo $this->ajaxResponse("message", [
                    "icon" => "icon-alert",
                    "type" => "alert",
                    "msgTitle" => "Opsss. Algo deu errado!",
                    "description" => "Por favor, informe um <b>E-mail</b> válido!"
                ]);
                return;
            }

            $name = explode(" ", $data["name"]);
            $first_name = $name[0];

            //send email
            $sendEmail = new \Source\Support\Email();
            $sendEmail->add(
                "Contato Via Site | " . SITE["name"],
                $this->view->render("_shared/emails/contact", [
                    "name" => $data["name"],
                    "email"=> $data["email"],
                    "message"=> $data["message"],
                    "date"=> date("d/m/Y"),
                ]),
                "Igor",
//                "hit@hitdigital.com.br"
                "rpcsistemasweb@gmail.com"
            )->send();

            echo $this->ajaxResponse("message", [
                "icon" => "icon-check",
                "type" => "success",
                "msgTitle" => "E-mail enviado com sucesso!",
                "description" => "Tudo certo {$first_name}. Sua mensagem foi enviada com sucesso!",
                "clear" => true
            ]);
            return;
        }

        $head = $this->seo->optimize(
            "Contato | " . SITE["name"],
            SITE["desc"],
            $this->router->route("web.contact"),
            asset("images/default.jpg")
        )->render();

        echo $this->view->render("web/widgets/home/contact", [
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
            asset("images/default.jpg")
        )->render();

        echo $this->view->render("web/error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}