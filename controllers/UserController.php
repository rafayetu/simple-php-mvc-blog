<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\UserModel;
use app\views\LoginView;
use app\views\RegistrationView;


class UserController extends Controller
{

    public function login(Request $request)
    {
        $userModel = Application::$app->user;

        if ($request->isPost()){

            $userModel->loadData($request->getBody());
            if ($userModel->login()) {
                return Application::$app->response->redirect("/");
            }
        }
        return $this->render(LoginView::class, [
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

        return  $this->render(RegistrationView::class, [
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