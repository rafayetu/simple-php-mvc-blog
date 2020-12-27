<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;

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

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        echo "<pre>";
        var_dump($body);
        echo "</pre>";
        exit;
        return "Contact POST";
    }

    public function postWrite()
    {
        $params = [
            "name" => "Simple MVC Blog"
        ];
        return $this->render("PostWriteView", $params);
    }


}