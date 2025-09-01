<?php

namespace controllers;

use models\UserModel;

class UserController
{
    private \PDO $dbConnection;
    private UserModel $userModel;

    public function __construct(\PDO $dbConnection)
    {
        $this->dbConnection = $dbConnection;
        $this->userModel = new UserModel($this->dbConnection);
    }

    public function showLogin(): void 
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }

        require_once __DIR__ . '/../views/render/login.php';
    }

    public function login(string $email, string $password): void
    {
        $user = $this->userModel->verifyLogin($email, $password);

        if ($user) {
            echo "User login successfull";
        } else {
            echo "User login failed";
        }
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        echo "Log out successful";
    }

    public function register(string $email, string $password): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $success = $this->userModel->createUser($email, $hashedPassword);

        if ($success) {
            echo "Registered user successfuly";
        } else {
            echo "Error while trying to register user, user with this email might exist allready";
        }
    }

    public function showProfile(int $userId): void
    {
        $user = $this->userModel->getUserId($userId);

        if ($user) {
            echo "User: " . $user['email'];
        } else {
            echo "User not found.";
        }
    }

    public function updateProfile(int $userId, string $email, ?string $password): void
    {
        $hashedPassword = null;

        if ($password !== null && !empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }

        $success = $this->userModel->updateUser($userId, $email, $hashedPassword);

        if ($success) {
            echo "Profile updated successfuly";
        } else {
            echo "Error while trying to update profile";
        }
    }

    public function deleteProfile(int $userId): void
    {
        $success = $this->userModel->deleteUser($userId);

        if ($success) {
            echo "User deleted successfuly";
        } else {
            echo "Error while trying to delete User";
        }
    }
}