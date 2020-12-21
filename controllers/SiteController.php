<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            "name" => "Simple MVC Blog"
        ];
        return $this->render("HomeView", $params);
    }


    public function contact()
    {
        $params = [
            "name" => "Simple MVC Blog"
        ];
        return $this->render("ContactView", $params);
    }

    public function handleContact()
    {
        return "Contact POST";
    }

}