<?php

//use app\core;
require_once __DIR__ . '/../vendor/autoload.php';
use app\core\Application;
use app\controllers;



$app = new Application();

$app->router->get("/", [controllers\SiteController::class, 'home']);

$app->router->get("/contact", [controllers\SiteController::class, 'contact']);
$app->router->post("/contact", [controllers\SiteController::class, 'handleContact']);

$app->run();