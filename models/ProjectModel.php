<?php

namespace model;

class ProjectModel
{
    private PDO $dbconnection;

    public function __constructor(PDO $dbConnectionParameter)
    {
        $this->dbconnection = $dbConnectionParameter;
    }

    public function getAllProjects(int $userId): array
    {
        $sql = 'SELECT * FROM projects WHERE userId = :userId';

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute([':userId' => $userId]);
            $projects = $stmt->fetctAll(PDO::FETCH_ASSOC);
            return $projects;
        } catch (PDOException $err) {
            echo 'Error in getAllProjects -method: ' . $err->getMessage();
            return [];
        }
    }

    public function getProjectCount(int $userId): int 
    {
        $sql = 'SELECT COUNT(*) FROM projects WHERE userId = :userId';

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute([':userId' => $userId]);
            $projectCount = $stmt->fetchColumn();
            return $projectCount;
        } catch(PDOException $err) {
            echo 'Error in getProjectCount -method: ' . $err->getMessage();
            return 0;
        }
    }

    public function getProject(int $projectId, int $userId): ?array
    {
        $sql = 'SELECT * FROM Projects WHERE id = :projectId AND userId = :userId';
        
        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute([':projectId' => $projectId, ':userId' => $userId]);
            $project = $stmt->fetch(PDO::FETCH_ASSOC);
            return $project ?: null;
        } catch(PDOException $err) {
            echo 'Error in getProject -method: ' . $err->getMessage();
            return null;
        }
    }

    public function addProject(array $projectData): bool
    {
        $sql = 'INSERT INTO projects (title, category, userId) VALUES (:title, :category, :userId)';

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $success = $stmt->execute([
                ':title' => $projectData['title'],
                ':category' => $projectData['category'],
                ':userId' => $projectData['userId']
            ]);
            return $success;
        } catch (PDOException $err) {
            echo 'Error in addProject -method: ' . $err->getMessage();
            return false;
        }
    }

    public function updateProject(int $projectId, int $userId, array $projectData): bool
    {
        $setClauses = [];
        $params = [':projectId' => $projectId, ':userId' => $userId];

        foreach ($projectData as $key => $value) {
            $setClauses[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        if (empty($setClauses)) {
            return false;
        }

        $sql = 'UPDATE projects SET ' . implode(', ', $setClauses) . ' WHERE id = :projectId AND userId = :userId';

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $err) {
            echo 'Error in updateProject -method: ' . $err->getMessage();
            return false;
        }
    }

    public function deleteProject(int $projectId, int $userId): bool
    {
        $sql = 'DELETE FROM projects WHERE id = :projectId AND userId = :userId';
        
        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute([
                ':projectId' => $projectId,
                ':userId' => $userId
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $err) {
            echo 'Error in deleteProject -method: ' . $err->getMessage();
            return false;
        }
    }

    public function searchProject(string $keyword, int $userId): array
    {
        $sql = 'SELECT * FROM projects WHERE title LIKE :keyword AND userId = :userId';

        try {
            $stmt = $this->dbconnection->prepare($sql);
            $stmt->execute([
                ':keyword' => '%' . $keyword . '%',
                ':userId' => $userId
            ]);
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $projects;
        } catch (PDOException $err) {
            echo 'Error in searchProject -method: ' . $err->getMessage();
            return [];
        }
    }
}