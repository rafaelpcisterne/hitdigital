<?php
ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(site());

/**
 * WEB
 */
$router->namespace("Source\App\Web");
$router->group(null);


$router->get("/", "Web:home", "web.home");

$router->get("/contato", "Web:contact", "web.contact");
$router->post("/contato", "Web:contact", "web.contact");

/* ################################ */
/* ############ ADMIN ############ */
/* ################################ */
$router->namespace("Source\App\Admin");
/**
 * AUTH
 */
$router->post("/login", "Auth:login", "auth.loginAdmin");
$router->post("/forget", "Auth:forget", "auth.forgetAdmin");
$router->post("/reset", "Auth:reset", "auth.resetAdmin");

$router->group("/admin");
$router->get("/", "Admin:home", "admin.home");
$router->get("/sair", "Admin:logoff", "admin.logoff");

/**
 * LOGIN
 */
$router->get("/entrar", "Login:home", "login.home");
$router->get("/recuperar", "Login:forget", "login.forget");
$router->get("/senha/{email}/{forget}", "Login:reset", "login.reset");

/**
 * INTRODUCTION
 */
$router->get("/introducao","Introduction:home","introduction.home");
$router->post("/introducao","Introduction:home","introduction.home");

/**
 * ERRORS
 */
$router->namespace("Source\App\Web");
$router->group("ops");
$router->get("/{errcode}", "Web:error", "web.error");

/**
 * ROUTE PROCESS
 */
$router->dispatch();

/**
 * ERRORS PROCESS
 */
if ($router->error()) {
    $router->redirect("web.error", ["errcode" => $router->error()]);
}

ob_end_flush();