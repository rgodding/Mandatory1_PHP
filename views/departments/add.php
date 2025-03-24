<?php
require_once '../../initialise.php';

$pageTitle = 'Departments';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';

// Maybe put this into seperate place after understanding how to use it
require_once ROOT_PATH . '/classes/Department.php';
$projectDb = new Department();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    try {
        // Add an employee to a project
        if($action==='add_department') {
            // $employees = (new Employee())->getAll();
            $result = $projectDb->add($_POST['name']);
            if (!$result) {
                die("Employee already assigned to project.");
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


echo <<<HTML
<h1>Add Department</h1>
<form action="add.php" method="POST">
    <div>
        <label for="name">Department Name:</label>
        <input type="text" id="name" name="name">
        <input type="hidden" name="action" value="add_department">
        <button type="submit">Add Department</button>
    </div>
</form>
HTML;
?>

<?php include_once ROOT_PATH . '/public/footer.php'; ?>