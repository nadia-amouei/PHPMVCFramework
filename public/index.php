<?php

//ini_set('display_errors','1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

use app\controllers\AuthController;
use app\controllers\SiteControllers;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/',  [SiteControllers::class, 'home']);
$app->router->get('/home', [SiteControllers::class, 'home']);
$app->router->get('/contact', [SiteControllers::class, 'contact']);
$app->router->post('/contact', [SiteControllers::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);

$app->run();
