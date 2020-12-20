<?php

//use app\core;
require_once __DIR__.'/vendor/autoload.php';
use app\core;



$app = new core\Application();

$app->router->get("/", function(){
    return "Hello World";
});


$app->run();