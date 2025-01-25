<?php
namespace app\core;

use app\core\db\Database;

class Application
{
    public string $layout = 'main';
    public static string $ROOT_DIR;
    public static Application $app;
    public ?Controller $controller = null;
    public string $userClass;
    public Request $request;
    public Response $response;
    public Router $router;
    public Session $session;
    public ?UserModal $user;
    public View $view;

    public Database $db;

    public function __construct($rootpath, array $config)
    {
        self::$ROOT_DIR = $rootpath;
        self::$app = $this;
        $this->userClass = $config['userClass'];
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        $this->user = null;
        if ($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey =>  $primaryValue]);
        }

    }

    public static function isGust()
    {
        return !self::$app->user;
    }

    public function login(UserModal $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error',[
                'exception' => $e
            ]);
        }
    }

}