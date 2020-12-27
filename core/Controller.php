<?php


namespace app\core;

abstract class Controller
{
    public function render($view, $params = [])
    {
        $view = new $view();
        return $view->render($params);
    }
}
