<?php


namespace app\controllers;


use app\core\Controller;
use app\views;



class SiteController extends Controller
{
    public function home()
    {
        $params = [
            "name" => "Simple MVC Blog"
        ];
        return $this->render(views\HomeView::class, $params);
    }


    public function contact()
    {
        $params = [
            "name" => "Simple MVC Blog"
        ];
        return $this->render(views\ContactView::class, $params);
    }


    public function postWrite()
    {
        $params = [
            "name" => "Simple MVC Blog"
        ];
        return $this->render(views\PostWriteView::class, $params);
    }


}