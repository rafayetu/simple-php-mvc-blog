<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\models\RegistrationModel;

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
        $registerModel = new RegistrationModel();

        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->is_valid && $registerModel->register()) {
                return "Success";
            }
            $data = $request->getBody();
        }

        return  $this->render("RegistrationView", [
            "model" => $registerModel,
            "errors" => $registerModel->errors
        ]);
    }
}