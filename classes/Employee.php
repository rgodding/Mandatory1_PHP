<?php
require_once 'Database.php';

/*
firstName, lastName, email, birth, departmentID
*/
class Employee extends Database
{
    function getAll(): array|false
    {
        $sql = <<<SQL
        SELECT employeeId, firstName, lastName, email, birth, departmentId
        FROM employee
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

    function getById(int $employeeId): array|false
    {
        $sql = <<<SQL
        SELECT employeeId, firstName, lastName, email, birth, departmentId
        FROM employee
        WHERE employeeId = :employeeId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':employeeId', $employeeId, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                return $stmt->fetch();
            }
            // No employee found
            return false;
        } catch (PDOException $e) {
            // Error fetching employee
            // TODO: log the error and distinguish from no employee found
            return false;
        }
    }

    function add(string $firstName, string $lastName, string $email, string $birth, string $departmentId): bool {
        $sql = <<<SQL
        INSERT INTO employee (firstName, lastName, email, birth, departmentId)
        VALUES (:firstName, :lastName, :email, :birth, :departmentId)
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':firstName', $firstName);
            $stmt->bindValue(':lastName', $lastName);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':birth', $birth);
            $stmt->bindValue(':departmentId', $departmentId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function update(int $employeeId, string $firstName, string $lastName, string $email, string $birth, int $departmentId): bool 
    {
        $sql = <<<SQL
        UPDATE employee
        SET firstName = :firstName, lastName = :lastName, email = :email, birth = :birth, departmentId = :departmentId
        WHERE employeeId = :employeeId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':employeeId', $employeeId, PDO::PARAM_INT);
            $stmt->bindValue(':firstName', $firstName);
            $stmt->bindValue(':lastName', $lastName);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':birth', $birth);
            $stmt->bindValue(':departmentId', $departmentId, PDO::PARAM_INT);
            return $stmt->execute();
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


    function getByProjectId(int $projectId): array|false
    {
        $sql = <<<SQL
        SELECT e.employeeId, e.firstName, e.lastName, e.birth
        FROM employee e
        INNER JOIN employee_project ep ON e.employeeId = ep.employeeId
        WHERE ep.projectId = :projectId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':projectId', $projectId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function getByDepartmentId(int $departmentId): array|false
    {
        $sql = <<<SQL
        SELECT employeeId, firstName, lastName, birth
        FROM employee
        WHERE departmentId = :departmentId
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':departmentId', $departmentId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }


};
