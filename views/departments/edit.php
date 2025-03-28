<?php

require_once '../../initialise.php';

$pageTitle = 'Departments';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';

require_once ROOT_PATH . '/classes/Department.php';
require_once ROOT_PATH . '/classes/Employee.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    try {
        // Add an employee to a project
        if($action==='delete') {
            // $employees = (new Employee())->getAll()
            $result = (new Department())->delete($_POST['id']);
            if (!$result) {
                die("Error deleting department.");
            }
        } else {
            die("Invalid action.");
        }
    } catch (PDOException $e) {
        // Log the error
        error_log($e->getMessage());
        header("Location: index.php");
        exit;
    }

    // Redirect back to the department index
    header("Location: index.php");
    exit;
}

$departmentEmployees = (new Employee())->getByDepartmentId($_GET['id']);
$employees = (new Employee())->getAll();

// Remove employees already assigned to the department
foreach ($departmentEmployees as $departmentEmployee) {
    foreach ($employees as $key => $employee) {
        if ($employee['employeeId'] === $departmentEmployee['employeeId']) {
            unset($employees[$key]);
        }
    }
}

if (!isset($_GET['id'])) {
    die("Department ID not provided.");
}

$departmentId = $_GET['id'];

// Here you would fetch the department from your database using $departmentId
// Example:
$department = (new Department())->getById($departmentId);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
</head>

<body>
    <h1>Edit Department</h1>
    <form action="update_department.php" method="POST">
        <div>
            <input type="hidden" name="id" value="<?= $departmentId ?>">
            <label for="name">Department Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($department['name']) ?>">
            <input type="hidden" name="departmentId" value="<?= $departmentId ?>">
            <input type="hidden" name="action" value="update_department">
            <button type="submit">Save Changes</button>
        </div>
    </form>
    <!-- Assigned Employees -->
<h3>Assigned Employees</h3>
<ul>
    <?php foreach ($departmentEmployees as $employee) : ?>
        <li>
            <?= $employee['firstName'] ?> <?= $employee['lastName'] ?>
        </li>
    <?php endforeach; ?>
</ul>
<!-- Unavailable for now because delete method hasn't been implemented proper yet
    <h1>Delete Department</h1>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= $departmentId ?>">
        <input type="hidden" name="action" value="delete">
        <button type="submit">Delete Department</button>
    </form>
-->
</body>

</html>