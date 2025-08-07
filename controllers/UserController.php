<?php

namespace controllers;

use models\UserModel;

class UserController
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = userModel;
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

    }

    public function register(string $email, string $password): void
    {

    }

    public function showProfile(int $userId): void
    {

    }

    public function updateProfile(int $userId, string $email, string $password): void
    {

    }

    public function deleteProfile(int $userId): void
    {

    }
}