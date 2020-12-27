<?php


namespace app\core;


abstract class View
{
    const MAIN = "main";
    const FULLPAGE = "fullpage";
    protected string $layout = self::MAIN;
    protected string $template;

    public function __construct()
    {
        $this->setDefaultTemplate();
    }


    public function render($params = [])
    {
        return $this->renderView($params);
    }

    public function renderView(array $params = [])
    {
        $layoutContent = $this->layoutContent($params);
        $viewContent = $this->renderOnlyView($params);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    protected function layoutContent($params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once ROOT_DIR . "/views/layouts/" . "{$this->getLayout()}.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once ROOT_DIR . "/views/templates/" . "{$this->getTemplate()}.php";
        return ob_get_clean();
    }

    public function getLayout(): string
    {
        return $this->layout;
    }

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template): void
    {
        $this->template = $template;
    }

    private function setDefaultTemplate()
    {
        $viewPath = explode('\\', static::class);
        $this->setTemplate(str_replace("View", "Template", end($viewPath)));

    }
}