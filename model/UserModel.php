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

    public function updateUser(int $userId, array $data): bool
    {
        $setClauses = [];
        $params = [':id' => $id];

        foreach ($data as $key => $value) {
            if ($key === 'password') {
                $setClauses[] = 'password_hash = :password_hash';
                $params[':password_hash'] = password_hash($value, PASSWORD_DEFAULT);
            } else {
                $setClauses[] = '$key = :$key';
                $params[':$key'] = $value;
            }
        }

        if (empty($setClauses)) {
            return false;
        }

        $sql = 'UPDATE user SET ' . implode(', ', $setClauses) . "WHERE id = :id";

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $err) {
            echo('Error during user update (ID: $id)' . $err->getMessage());
            return false;
        }
    }
    
    public function deleteUser(int $userId): bool
    {
        $sql = 'DELETE FROM user WHERE Id = :userId';

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute([':userId' => $userId]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $err) {
            echo('Error while tying to delete user: ' . $err->getMessage());
            return false;
        }
    }
}