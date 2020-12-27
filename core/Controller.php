<?php


namespace app\core;

abstract class Controller
{
    public function render($view, $params = [])
    {
        $view = new $view();
        return $view->render($params);
    }

    public function loginRequired()
    {
        if (!Application::$app->user->isUserLoggedIn){
            Application::$app->response->redirect("/login");
            exit();
        }
    }
}