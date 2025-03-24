<?php
require_once '../../initialise.php';

$pageTitle = 'Employees';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';

// Maybe put this into seperate place after understanding how to use it
require_once ROOT_PATH . '/classes/Employee.php';

$projectDb = new Employee();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    error_log("First Name: " . $_POST['firstName']);
    error_log("Last Name: " . $_POST['lastName']);
    error_log("Birth: " . $_POST['birth']);
    error_log("Department ID: " . $_POST['departmentId']);
    try {
        // Add an employee to a project
        if ($action === 'add_employee') {
            $newEmployee = $projectDb->add(
                $_POST['firstName'],
                $_POST['lastName'],
                $_POST['email'],
                $_POST['birth'],
                $_POST['departmentId']
            );
            if (!$newEmployee) {
                die("Failed to add employee.");
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

echo <<<HTML
<h1>Add Employee</h1>
<form action="add.php" method="POST">
    <div>
        <label for="name">First Name:</label>
        <input type="text" id="firstName" name="firstName">
    </div>
    <div>
        <label for="name">Last Name:</label>
        <input type="text" id="lastName" name="lastName">
    </div>
    <div>
        <label for="name">Email:</label>
        <input type="text" id="email" name="email">
    </div>
    <div>
        <label for="name">Birth:</label>
        <input type="date" id="birth" name="birth">
    </div>
    <div>
    <label for="departmentId">Department:</label>
    <select id="departmentId" name="departmentId">
        <option value="1">HR</option>
        <option value="2">IT</option>
        <option value="3">Finance</option>
    </select>
    </div>
    <input type="hidden" name="action" value="add_employee">
    <button type="submit">Add Employee</button>
</form>
HTML;
?>

<?php include_once ROOT_PATH . '/public/footer.php'; ?>