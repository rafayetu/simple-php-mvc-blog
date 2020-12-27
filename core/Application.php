<?php


namespace app\core;


use app\models\UserModel;

class Application
{
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    private Controller $controller;
    public Session $session;
    public Database $db;
    public UserModel $user;



    public function __construct()
    {
        $config = $this->loadConf();
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config["db"]);
        $this->user = new UserModel();
        $this->user->verifyUser();

    }

    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function loadConf()
    {
        return [
            'db' => [
                'dsn' => $_ENV["DB_DSN"],
                'username' => $_ENV["DB_USER"],
                'password' => $_ENV["DB_PASSWORD"],

            ]
        ];
    }
}