<?php
/**
 * DATABASE CONNECT
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "hit",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.hitdigital.com.br");
define("CONF_URL_TEST", "https://www.localhost/hit");

/**
 * SITE
 */
define("CONF_SITE_NAME", "Hit Marketing Digital");
define("CONF_SITE_TITLE", "Agência de Marketing Digital e Inovação!");
define("CONF_SITE_DESC",
    "Somos uma agência de Marketing Digital e inovação. Entre nossos serviços principais estão a criação de sites responsivos, criação de aplicativos para IOS e Android, gestão de redes sociais, SEO, adwords entre outros. Clique e saiba mais sobre como podemos ajudá-lo a gerar resultados.");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "https://www.hitdigital.com.br");
define("CONF_SITE_ADDR_STREET", "Av. Therezinha Pauletti Sanvitto");
define("CONF_SITE_ADDR_NUMBER", "208");
define("CONF_SITE_ADDR_COMPLEMENT", "Sala 913");
define("CONF_SITE_ADDR_CITY", "Caxias do Sul");
define("CONF_SITE_ADDR_STATE", "RS");
define("CONF_SITE_ADDR_ZIPCODE", "95110-195");

/**
 * SITE CONFIG
 */
define("SITE", [
    "name" => CONF_SITE_NAME,
    "desc" => CONF_SITE_DESC,
    "domain" => CONF_SITE_DOMAIN,
    "locale" => CONF_SITE_LANG,
    "root" => (strpos($_SERVER['HTTP_HOST'], "localhost") ? CONF_URL_TEST : CONF_URL_BASE),
]);

/**
 * SITE MINIFY
 */
if ($_SERVER["SERVER_NAME"] == "www.localhost") {
    require __DIR__ . "/Minify/Web.php";
    require __DIR__ . "/Minify/Admin.php";
}

/**
 * SOCIAL CONFIG
 */
define("SOCIAL", [
    "facebook_page" => "page",
    "facebook_author" => "author",
    "facebook_appId" => "app",
    "twitter_creator" => "@rafaelpcisterne",
    "twitter_site" => "@rafaelpcisterne"
]);

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../themes/_shared/emails");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "web");
define("CONF_VIEW_ADMIN", "admin");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "");
define("CONF_MAIL_PORT", "");
define("CONF_MAIL_USER", "");
define("CONF_MAIL_PASS", "");
define("CONF_MAIL_SENDER", ["name" => "NOME", "address" => "EMAIL"]); //address (ex: email@emailsender.com)
define("CONF_MAIL_SUPPORT", "");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");