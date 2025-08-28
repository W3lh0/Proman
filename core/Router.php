<?php

namespace core;

use PDO;
use models\UserModel;
use controllers\UserController;

class Router
{
    private array $routes = [];
    private PDO $dbConnection;
    private UserModel $userModel;

    public function __construct(\PDO $dbConnection, UserModel $userModel)
    {
        $this->dbConnection = $dbConnection;
        $this->userModel = $userModel;
    }

    public function get(string $path, string $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, string $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function put(string $path, string $handler): void
    {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete(string $path, string $handler): void
    {
        $this->addRoute('DELETE', $path, $handler);
    }

    public function dispatch(string $requestMethod, string $requestURI): void
    {
        $route = $this->matchRoute($requestURI, $requestMethod);

        if (!$route) {
            throw new \Exception("Can't find route '{$requestURI}' and method '{$requestMethod}'.");
        }

        [$controllerName, $actionName] = explode('@', $route['handler']);

        $controller = $this->createController($controllerName);

        if (!method_exists($controller, $actionName)) {
            throw new \Exception("Method '{$actionName}' ei löydy kontrollerista '{$controllerName}'.");
        }

        $controller->$actionName();
    }

    private function addRoute(string $method, string $path, string $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    private function matchRoute(string $path, string $method): ?array
    {
        foreach ($this->routes as $route) {
            if ($route['path'] === $path && $route['method'] === $method) {
                return $route;
            }
        }
        return null;
    }

    private function createController(string $controllerName): object
    {
        $fullControllerName = 'controllers\\' . $controllerName;

        if (!class_exists($fullControllerName)) {
            throw new \Exception("Can't find controller '{$fullControllerName}'.");
        }
        return new $fullControllerName($this->userModel);
    }
}