<?php

namespace controllers;

use models\UserModel;

class UserController
{
    private UserModel $userModel;

    public function __constructor(UserModel $userModel)
    {
        $this->userModel = userModel;
    }

    public function login(string $email, string $password): void
    {

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