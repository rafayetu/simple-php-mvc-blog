<?php

define("ROOT_DIR", dirname(__DIR__) );

require_once ROOT_DIR . '/vendor/autoload.php';

use app\controllers\AuthenticationController;
use app\controllers\SiteController;
use app\core\Application;

Dotenv\Dotenv::createImmutable(ROOT_DIR. "/conf")->load();




$app = new Application();

$app->router->get("/", [SiteController::class, 'home']);
$app->router->get("/contact", [SiteController::class, 'contact']);
$app->router->post("/contact", [SiteController::class, 'handleContact']);

$app->router->get("/login", [AuthenticationController::class, 'login']);
$app->router->post("/login", [AuthenticationController::class, 'login']);
$app->router->get("/register", [AuthenticationController::class, 'register']);
$app->router->post("/register", [AuthenticationController::class, 'register']);

$app->run();