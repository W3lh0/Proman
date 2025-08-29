<?php

define('ROOT_PATH', dirname(__DIR__));

session_start();

require_once ROOT_PATH . '/models/config.php';

spl_autoload_register(function ($className) {
    $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    $fullPath = ROOT_PATH . DIRECTORY_SEPARATOR . $filePath;

    if (file_exists($fullPath)) {
        require_once $fullPath;
    }
});

use core\Router;
use core\Connection;
use controllers\UserController;
use function core\normalizeUri;

require_once ROOT_PATH . '/core/helpers.php';

$dbConnection = new Connection($host, $dbName, $userName, $password, $options);
$pdo = $dbConnection->getConnection();
$userModel = new \models\UserModel($pdo);
$userController = new \controllers\UserController($userModel);

$router = new Router($pdo, $userModel);

require_once ROOT_PATH . '/public/routes.php';

$basePath = '/~e2101506/php/proman/public';
$normalizedUri = normalizeUri($_SERVER['REQUEST_URI'], $basePath);

$router->dispatch($_SERVER['REQUEST_METHOD'], $normalizedUri);