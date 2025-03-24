<?php

require_once '../../initialise.php';

$pageTitle = 'Projects';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';

require_once ROOT_PATH . '/classes/Project.php';
require_once ROOT_PATH . '/classes/Employee.php';

$projectEmployees = (new Employee())->getByProjectId($_GET['id']);
$employees = (new Employee())->getAll();

// Remove employees already assigned to the project
foreach ($projectEmployees as $projectEmployee) {
    foreach ($employees as $key => $employee) {
        if ($employee['employeeId'] === $projectEmployee['employeeId']) {
            unset($employees[$key]);
        }
    }
}

if (!isset($_GET['id'])) {
    die("Project ID not provided.");
}

$projectId = $_GET['id'];

// Here you would fetch the project from your database using $projectId
// Example:
$project = (new Project())->getById($projectId);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
</head>

<body>
    <h1>Edit Project</h1>
    <form action="update_project.php" method="POST">
        <div>
            <input type="hidden" name="id" value="<?= $projectId ?>">
            <label for="name">Project Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($project['name']) ?>">
            <input type="hidden" name="projectId" value="<?= $projectId ?>">
            <input type="hidden" name="action" value="update_project">
            <button type="submit">Save Changes</button>
        </div>
    </form>
    <!-- Assigned Employees -->
<h3>Assigned Employees</h3>
<ul>
    <?php foreach ($projectEmployees as $employee) : ?>
        <li>
            <?= $employee['firstName'] ?> <?= $employee['lastName'] ?>
            <form action="update_project.php" method="POST" style="display:inline;">
                <input type="hidden" name="employeeId" value="<?= $employee['employeeId'] ?>">
                <input type="hidden" name="projectId" value="<?= $projectId ?>">
                <input type="hidden" name="action" value="remove_employee">
                <button type="submit">Remove</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Unassigned Employees -->
<h3>Unassigned Employees</h3>
<ul>
    <?php foreach ($employees as $employee) : ?>
        <li>
            <?= $employee['firstName'] ?> <?= $employee['lastName'] ?>
            <form action="update_project.php" method="POST" style="display:inline;">
                <input type="hidden" name="employeeId" value="<?= $employee['employeeId'] ?>">
                <input type="hidden" name="projectId" value="<?= $projectId ?>">
                <input type="hidden" name="action" value="add_employee">
                <button type="submit">Add</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
</body>

</html>