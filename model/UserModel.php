<?php

class UserModel
{
    private PDO $dbconnection;

    public function __constructor(PDO $dbConnectionParameter)
    {
        $this->dbconnection = $dbConnectionParameter;
    }

    public function verifyLogin(string $email, string $password): int 
    {
        $sql = "SELECT id, password_hash FROM user WHERE email = :email LIMIT 1";

        $stmt = $this->dbconnection->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user['id'];
        }

        return 0;
    }

    public function addUser(string $email, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (email, password_hash) VALUES (:email, :password_hash)";

        try {
            $stmt = $this->dbconnection->prepare($sql);

            $stmt->execute([
                ':email' => $email,
                ':password_hash' => $hashedPassword
            ]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $err) {
            echo('Adding user failed: ' . $err->getMessage());
            return false;
        }
    }

    public function deleteUser()
    {

    }
}