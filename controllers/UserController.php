<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\UserModel;


class UserController extends Controller
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
        $userModel = Application::$app->user;

        if ($request->isPost()){

            $userModel->loadData($request->getBody());
            if ($userModel->login()) {
                return Application::$app->response->redirect("/");
            }
        }
        return $this->render("LoginView", [
            "model" => $userModel
        ]);
    }

    public function register(Request $request){
        $userModel = Application::$app->user;

        if ($request->isPost()) {
            $userModel->loadData($request->getBody());
            if ($userModel->register()) {
                return Application::$app->response->redirect("/");
            }
        }

        return  $this->render("RegistrationView", [
            "model" => $userModel
        ]);
    }

    public function logout(Request $request)
    {
        $userModel = Application::$app->user;
        $userModel->logout();
//        if ($request->isPost()) {
//            $userModel->logout();
//        }
        return Application::$app->response->redirect("/");
    }
}