<?php
require_once '../../initialise.php';

$pageTitle = 'Departments';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';

// Maybe put this into seperate place after understanding how to use it
require_once ROOT_PATH . '/classes/Department.php';

$departments = (new Department())->getAll();

if (!$departments) {
    $errorMessage = 'No departments found';
} else {
    $errorMessage = '';
}
echo <<<HTML
HTML;
echo <<<HTML
<table class="data-table">
    <thead class="data-table-header">
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody class="data-table-body">
HTML;
foreach ($departments as $department) {
    echo <<<HTML
        <tr>
            <td>{$department['departmentId']}</td>
            <td>{$department['name']}</td>
        </tr>
HTML;
}
echo <<<HTML
    </tbody>
</table>
<button>
    <a href="add.php">Add Department</a>
</button>
HTML;
?>

<?php include_once ROOT_PATH . '/public/footer.php'; ?>