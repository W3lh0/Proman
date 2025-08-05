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
use controllers\UserController;

