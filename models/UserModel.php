<?php

namespace models;

class UserModel
{
    private \PDO $dbconnection;

    public function __construct(\PDO $dbConnectionParameter)
    {
        $this->dbconnection = $dbConnectionParameter;
    }

    public function verifyLogin(string $email, string $password)
    {
        $sql = "SELECT id, password_hash FROM users WHERE email = :email LIMIT 1";

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                return $user;
            }
        } catch (PDOException $err) {
            echo 'Login verification failed:' . $err->getMessage();
        }

        return false;
    }

    public function addUser(string $email, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (email, password_hash) VALUES (:email, :password_hash)";

        try {
            $stmt = $this->dbconnection->prepare($sql);

            $stmt->execute([
                ':email' => $email,
                ':password_hash' => $hashedPassword
            ]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $err) {
            echo 'Adding user failed: ' . $err->getMessage();
            return false;
        }
    }

    public function updateUser(int $userId, array $data): bool
    {
        $setClauses = [];
        $params = [':id' => $userId];

        foreach ($data as $key => $value) {
            $paramKey = ':' . $key;
            if ($key === 'password') {
                $setClauses[] = "password_hash = $paramKey";
                $params[$paramKey] = password_hash($value, PASSWORD_DEFAULT);
            } else {
                $setClauses[] = "$key = :$paramKey";
                $params[$paramKey] = $value;
            }
        }

        if (empty($setClauses)) {
            return false;
        }

        $sql = 'UPDATE users SET ' . implode(', ', $setClauses) . "WHERE id = :id";

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $err) {
            echo 'Error during user update (ID: $id) ' . $err->getMessage() ;
            return false;
        }
    }
    
    public function deleteUser(int $userId): bool
    {
        $sql = 'DELETE FROM users WHERE Id = :userId';

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute([':userId' => $userId]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $err) {
            echo 'Error while tying to delete user: ' . $err->getMessage();
            return false;
        }
    }
}