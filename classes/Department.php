<?php
require_once 'Database.php';

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
};
