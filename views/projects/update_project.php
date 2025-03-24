<?php
require_once '../../initialise.php';
require_once ROOT_PATH . '/classes/Database.php';
require_once ROOT_PATH . '/classes/Project.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employeeId'] ?? null;
    $projectId = $_POST['projectId'] ?? null;
    $action = $_POST['action'] ?? null;

    // All actions require a project ID and an action
    if (!$projectId || !$action) {
        die("Invalid input.");
    }

    $projectDb = new Project();

    try {
        // Add an employee to a project
        if ($action === 'add_employee') {
            // $employees = (new Employee())->getAll();
            $result = $projectDb->addEmployeeToProject($employeeId, $projectId);
            $projectDb = new Project();
            if (!$result) {
                die("Employee already assigned to project.");
            }
            // Remove an employee from a project
        } elseif ($action === 'remove_employee') {
            $result = $projectDb->removeEmployeeFromProject($employeeId, $projectId);
            $projectDb = new Project();
            if (!$result) {
                die("Employee not found in project.");
            }
            // Update a project, right now only name can be updated
        } elseif ($action === 'update_project') {
            $result = $projectDb->update($projectId, $_POST['name']);
            $projectDb = new Project();
            if (!$result) {
                die("Error updating project name.");
            }
        } else {
            die("Invalid action.");
        }
    } catch (PDOException $e) {
        // Log the error
        error_log($e->getMessage());
        // Redirect back to the edit page
        header("Location: edit.php?id=$projectId");
        exit;
    }

    // Redirect back to the edit page
    header("Location: edit.php?id=$projectId");
    exit;
}
