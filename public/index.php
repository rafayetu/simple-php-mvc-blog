<?php

define("ROOT_DIR", dirname(__DIR__) );
define("SITE_NAME", "Simple MVC Blog" );

require_once ROOT_DIR . '/vendor/autoload.php';

use app\controllers\PostController;
use app\controllers\UserController;
use app\controllers\SiteController;
use app\core\Application;

Dotenv\Dotenv::createImmutable(ROOT_DIR. "/conf")->load();




$app = new Application();

$app->router->get("/", [SiteController::class, 'home']);
$app->router->get("/contact", [SiteController::class, 'contact']);
$app->router->post("/contact", [SiteController::class, 'handleContact']);

$app->router->get("/login", [UserController::class, 'login']);
$app->router->post("/login", [UserController::class, 'login']);
$app->router->get("/register", [UserController::class, 'register']);
$app->router->post("/register", [UserController::class, 'register']);
$app->router->get("/logout", [UserController::class, 'logout']);

$app->router->get("/post-editor", [PostController::class, 'postEditor']);
$app->router->post("/post-editor", [PostController::class, 'postEditor']);
$app->router->get("/post", [PostController::class, 'postRead']);
$app->router->get("/post-list", [PostController::class, 'postAuthor']);



$app->run();