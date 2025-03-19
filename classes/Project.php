<?php
require_once 'Database.php';

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
};
