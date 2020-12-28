<?php


namespace app\core;


use app\controllers\SiteController;
use app\views\NotFoundView;

class Router
{
    const PERMISSION_PUBLIC = 0;
    const PERMISSION_USER = 1;
    const PERMISSION_ADMIN = 2;
    protected array $routes = [];
    protected Request $request;
    protected Response $response;


    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback, $permission = self::PERMISSION_PUBLIC, $title = "")
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback, $permission = self::PERMISSION_PUBLIC, $title = "")
    {
        $this->routes['post'][$path] = $callback;
    }

    public function setRoute($path, $callback, $permission = self::PERMISSION_PUBLIC, $title = "", $namespace = "")
    {
        $this->routes[$path] = [
            "path" => $path,
            "callback" => $callback,
            "permission" => $permission,
            "title" => $title,
            "namespace" => strlen($namespace) ? $namespace : $path
        ];
    }

    public function getRoute()
    {
        $path = $this->request->getPath();
        return $this->routes[$path[0]] ?? false;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $route = $this->routes[$path[0]] ?? false;

        if ($route && is_callable($route["callback"])) {
            $callback = $route["callback"];
            if (is_array($callback)) {
                $callback[0] = new $callback[0]();
                Application::$app->setController($callback[0]);
            }
            return call_user_func($callback, $this->request);
        } else {
            $controller = new SiteController();
            $this->response->setStatusCode(404);
            return $controller->render(NotFoundView::class);
        }
    }

    public function getPermittedRoutes($permission)
    {
        return array_filter($this->routes, fn($k) => $k["permission"] == $permission);
    }

    public function getRouteFromNamespace($namespace)
    {
        $route = array_filter($this->routes, fn($k) => $k["namespace"] == $namespace);
        if ($route){
            return array_values($route)[0];
        } else {
            return null;
        }
    }
}