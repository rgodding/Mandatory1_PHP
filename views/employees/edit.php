<?php

require_once '../../initialise.php';

$pageTitle = 'Projects';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';
require_once ROOT_PATH . '/classes/Employee.php';

// Get employee by employeeId


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $employeeDb = new Employee();
    error_log("STARTING TO UPDATE EMPLOYEE");

    try {
        // Add an employee to a project
        if ($action === 'update_employee') {
            $result = $employeeDb->update(
                (int)$_POST['id'],
                $_POST['firstName'],
                $_POST['lastName'],
                $_POST['email'],
                $_POST['birth'],
                // Turn departmentId into an integer
                (int)$_POST['departmentId']
            );
            if (!$result) {
                die("Failed to update employee.");
            }
        } elseif ($action === 'delete_employee') {
            error_log("DELETING EMPLOYEE");
            error_log("ID: " . $_POST['id']);
            $result = $employeeDb->delete((int)$_POST['id']);
            if (!$result) {
                die("Error deleting employee.");
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

    // Redirect back to the employee index
    header("Location: index.php");
    exit;
}



$employee = (new Employee())->getById($_GET['id']);

if (!$employee) {
    die($_GET['id'] . ' is not a valid employee ID.');
}

?>

<body>
    <h1>Edit Employee</h1>
    <form action="edit.php" method="POST">
        <div>
            <input type="hidden" name="id" value="<?= $employee['employeeId'] ?>">
            <label for="name">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($employee['firstName']) ?>">
        </div>
        <div>
            <label for="name">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($employee['lastName']) ?>">
        </div>
        <div>
            <label for="name">Email:</label>
            <input type="text" id="email" name="email" value="<?= htmlspecialchars($employee['email']) ?>">
        </div>
        <div>
            <label for="name">Birth:</label>
            <input type="date" id="birth" name="birth" value="<?= htmlspecialchars($employee['birth']) ?>">
        </div>
        <!-- TODO: Add department dropdown -->
        <div>
            <label for="departmentId">Department:</label>
            <select id="departmentId" name="departmentId">
                <option value="1" <?= $employee['departmentId'] == 1 ? 'selected' : '' ?>>Unassigned</option>
                <option value="2" <?= $employee['departmentId'] == 2 ? 'selected' : '' ?>>HR</option>
                <option value="3" <?= $employee['departmentId'] == 3 ? 'selected' : '' ?>>IT</option>
                <option value="4" <?= $employee['departmentId'] == 4 ? 'selected' : '' ?>>Finance</option>
            </select>
        </div>
        <input type="hidden" name="id" value="<?= $employee['employeeId'] ?>">
        <input type="hidden" name="action" value="update_employee">
        <button type="submit">Save Changes</button>
    </form>

    <h1>Delete Employee</h1>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= $employee['employeeId'] ?>">
        <input type="hidden" name="action" value="delete_employee">
        <button type="submit">Delete Employee</button>
    </form>
</body>

</html>