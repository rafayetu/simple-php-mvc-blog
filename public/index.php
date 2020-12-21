<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthenticationController;
use app\controllers\SiteController;
use app\core\Application;



$app = new Application();

$app->router->get("/", [SiteController::class, 'home']);
$app->router->get("/contact", [SiteController::class, 'contact']);
$app->router->post("/contact", [SiteController::class, 'handleContact']);

$app->router->get("/login", [AuthenticationController::class, 'login']);
$app->router->post("/login", [AuthenticationController::class, 'login']);
$app->router->get("/register", [AuthenticationController::class, 'register']);
$app->router->post("/register", [AuthenticationController::class, 'register']);

$app->run();