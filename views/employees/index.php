<?php
require_once '../../initialise.php';

$pageTitle = 'Employee';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';


// Maybe put this into seperate place after understanding how to use it
require_once ROOT_PATH . '/classes/Employee.php';

$employees = (new Employee())->getAll();

if (!$employees) {
    $errorMessage = 'No employees found';
} else {
    $errorMessage = 'E HAHA';
};
echo <<<HTML
HTML;
echo <<<HTML
<table class="data-table">
    <thead class="data-table-header">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Birth</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="data-table-body">
HTML;
foreach ($employees as $employee) {
    echo <<<HTML
        <tr>
            <td>{$employee['employeeId']}</td>
            <td>{$employee['firstName']}</td>
            <td>{$employee['lastName']}</td>
            <td>{$employee['email']}</td>
            <td>{$employee['birth']}</td>
            <td>{$employee['departmentId']}</td>
            <td>
                <button>
                    <a href="edit.php?id={$employee['employeeId']}">Edit</a>
                </button>
            </td>
        </tr>
HTML;
}
echo <<<HTML
    </tbody>
</table>
<button>
    <a href="add.php">Add Employee</a>
</button>
HTML;
?>

<?php include_once ROOT_PATH . '/public/footer.php'; ?>