<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\UserModel;


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
        $userModel = new UserModel();

        if ($request->isPost()) {
            $userModel->loadData($request->getBody());
            if ($userModel->register()) {
                Application::$app->session->setMessage("success", "Registration successful",
                    "You have successfully registered to Simple MVC Blog.");
                Application::$app->response->redirect("/");
                return null;
            }
            $data = $request->getBody();
        }

        return  $this->render("RegistrationView", [
            "model" => $userModel,
//            "errors" => $userModel->errors
        ]);
    }
}