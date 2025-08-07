<?php

session_start();

require_once 'model/config.php';

spl_autoload_register(function ($className) {
    $filePath = str_replace('\\', '/', $className) . '.php';
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});

use models\Connection;
use models\UserModel;
use models\ProjectModel;
use controllers\UserController;
use controllers\ProjectController;
use core\Router;

try {
    $dbConnection = new Connection($host, $dbName, $userName, $password, $options);
    $pdo = $dbConnection->getPdo();
} catch (PDOException $err) {
    die('Database connection error: ' . $err->getMessage());
}

$userModel = new UserModel($pdo);
$router = new Router();