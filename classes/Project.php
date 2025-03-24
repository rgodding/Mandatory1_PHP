<?php
require_once 'Database.php';

/*
name
*/
class Project extends Database
{
    function getAll(): array|false
    {
        $sql = <<<SQL
        SELECT projectId, name
        FROM project
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // TODO: log the error
            return false;
        }
    }

    function getById(int $id): array|false
    {
        $sql = <<<SQL
        SELECT name
        FROM project
        WHERE projectId = :projectId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':projectId', $id);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                return $stmt->fetch();
            }
            // No project found
            return false;
        } catch (PDOException $e) {
            // Error fetching project
            // TODO: log the error and distinguish from no project found
            return false;
        }
    }

    function add(string $name): bool {
        $sql = <<<SQL
        INSERT INTO project (name)
        VALUES (:name)
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':name', $name);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function update(int $projectId, string $name): bool
    {
        $sql = <<<SQL
        UPDATE project
        SET name = :name
        WHERE projectId = :projectId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':projectId', $projectId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function delete(int $projectId): bool {
        $sql = <<<SQL
        DELETE FROM project
        WHERE projectId = :projectId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':projectId', $projectId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function addEmployeeToProject(int $employeeId, int $projectId): bool
    {
        $sql = <<<SQL
        INSERT INTO employee_project (employeeId, projectId)
        VALUES (:employeeId, :projectId)
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':employeeId', $employeeId, PDO::PARAM_INT);
            $stmt->bindValue(':projectId', $projectId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function removeEmployeeFromProject(int $employeeId, int $projectId): bool
    {
        $sql = <<<SQL
        DELETE FROM employee_project
        WHERE employeeId = :employeeId AND projectId = :projectId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':employeeId', $employeeId, PDO::PARAM_INT);
            $stmt->bindValue(':projectId', $projectId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

};
