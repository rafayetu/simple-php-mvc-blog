<?php


namespace app\core;

use app\views;

class Controller
{
    protected string $layout = "main";

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return $this->renderView($view, $params);
    }

    public function renderView(string $view, array $params = [])
    {
        $layoutContent = $this->layoutContent($params);
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    protected function layoutContent($params)
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }
        $layout = $this->getLayout();
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/"."$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}
