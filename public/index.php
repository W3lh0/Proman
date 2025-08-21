<?php

define('ROOT_PATH', dirname(__DIR__));

session_start();

require_once ROOT_PATH . '/config.php';

spl_autoload_register(function ($className) {
    $filePath = ROOT_PATH . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});

use core\Connection;
use core\Router;
use models\UserModel;
use models\ProjectModel;
use controllers\UserController;
use controllers\ProjectController;

try {
    $dbConnection = (new Connection($host, $dbName, $userName, $password, $options))->getConnection();
    
    if (!$dbconnection) {
        throw new \Exception('Database connection is not available.');
    }
} catch (PDOException $err) {
    die('Database connection error: ' . $err->getMessage());
}

$userModel = new UserModel($pdo);

$userController = new UserController($userModel);

$router = new Router();
$router->setControllers($userController);

require_once ROOT_PATH . '/core/Routes.php';

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUIRE_URI']);