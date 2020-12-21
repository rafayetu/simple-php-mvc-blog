<?php


namespace app\core;


use app\controllers\SiteController;

class Router
{
    protected array $routes = [];
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $controller = new SiteController();
            $this->response->setStatusCode(404);
            return $controller->renderView("NotFoundView");
        } else if (is_string($callback)) {
            return Application::$app->getController()->renderView($callback);
        } else if (is_callable($callback)) {
            if (is_array($callback)) {
                $callback[0] = new $callback[0]();
                Application::$app->setController($callback[0]);
            }
            return call_user_func($callback, $this->request);
        } else {
            return $callback;
        }
    }

}