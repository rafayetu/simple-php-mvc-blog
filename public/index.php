<?php

define("ROOT_DIR", dirname(__DIR__) );
define("SITE_NAME", "Simple MVC Blog" );

require_once ROOT_DIR . '/vendor/autoload.php';

use app\controllers\PostController;
use app\controllers\SiteController;
use app\controllers\UserController;
use app\core\Application;
use app\core\Router;

Dotenv\Dotenv::createImmutable(ROOT_DIR. "/conf")->load();




$app = new Application();


$app->router->setRoute("/", [PostController::class, 'postAll'],
    Router::PERMISSION_PUBLIC, "Home", "home");
$app->router->setRoute("/profile", [PostController::class, 'postProfile'],
    Router::PERMISSION_PUBLIC, "Profile", "profile");


$app->router->setRoute("/login", [UserController::class, 'login'],
    Router::PERMISSION_PUBLIC, "Sign In", "login");
$app->router->setRoute("/register", [UserController::class, 'register'],
    Router::PERMISSION_PUBLIC, "Sign Up", "register");
$app->router->setRoute("/logout", [UserController::class, 'logout'],
    Router::PERMISSION_USER, "Sign out", "logout");



$app->router->setRoute("/post", [PostController::class, 'postRead'],
    Router::PERMISSION_PUBLIC, "Post", "post");
$app->router->setRoute("/post-editor", [PostController::class, 'postEditor'],
    Router::PERMISSION_USER, "Write a Post", "post-editor");
$app->router->setRoute("/post-list", [PostController::class, 'postAuthor'],
    Router::PERMISSION_USER, "Post List", "post-list");



$app->run();