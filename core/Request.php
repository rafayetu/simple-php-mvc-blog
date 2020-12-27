<?php


namespace app\core;


class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? "/";
        $position = strpos($path, '?');
        if ($position !== false) {
             $path = substr($path, 0, $position);
        }
        $path = explode("/", trim($path, "/"));
        return ["/$path[0]", array_slice($path, 1)];
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function isGet()
    {
        return strtolower($_SERVER['REQUEST_METHOD']) === 'get';
    }
    public function isPost()
    {
        return strtolower($_SERVER['REQUEST_METHOD']) === 'post';
    }

    public function getBody()
    {
        $body = [];
        if ($this->method() === 'get'){
            foreach ($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'post'){
            foreach ($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}