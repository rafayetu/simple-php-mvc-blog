<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;

class AuthenticationController extends Controller
{
    /**
     * AuthenticationController constructor.
     */
    public function __construct()
    {
        $this->setLayout('fullpage');
    }

    public function login(Request $request)
    {
        if ($request->isPost()){
            return "handle login data";
        }
        return $this->render("LoginView", []);
    }

    public function register(Request $request){
        if ($request->isPost()){
            return "handle registration data";
        }
        return  $this->render("RegistrationView", []);
    }
}