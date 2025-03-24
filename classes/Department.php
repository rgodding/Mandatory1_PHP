<?php
require_once 'Database.php';

/*
name
*/
class Department extends Database
{
    function getAll(): array|false
    {
        $sql = <<<SQL
        SELECT departmentId, name
        FROM department
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
        FROM department
        WHERE departmentId = :departmentId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':departmentId', $id);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                return $stmt->fetch();
            }
            // No department found
            return false;
        } catch (PDOException $e) {
            // Error fetching department
            // TODO: log the error and distinguish from no department found
            return false;
        }
    }

    function add(string $name): bool {
        $sql = <<<SQL
        INSERT INTO department (name)
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

    function update(int $departmentId, string $name): bool
    {
        $sql = <<<SQL
        UPDATE department
        SET name = :name
        WHERE departmentId = :departmentId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':departmentId', $departmentId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    function delete(int $departmentId): bool {
        $sql = <<<SQL
        DELETE FROM department
        WHERE departmentId = :departmentId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':departmentId', $departmentId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

};
