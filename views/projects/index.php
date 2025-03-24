<?php
require_once '../../initialise.php';

$pageTitle = 'Projects';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';


require_once ROOT_PATH . '/classes/Project.php';
require_once ROOT_PATH . '/classes/Employee.php';

$projects = (new Project())->getAll();

if (!$projects) {
    $errorMessage = 'No projects found';
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
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="data-table-body">
HTML;
foreach ($projects as $project) {
    echo <<<HTML
        <tr>
            <td>{$project['projectId']}</td>
            <td>{$project['name']}</td>
            <td>
                <button><a href="edit.php?id={$project['projectId']}">Edit</a></button>
            </td>
        </tr>
HTML;
}
echo <<<HTML
    </tbody>
</table>    
HTML;
?>

<?php include_once ROOT_PATH . '/public/footer.php'; ?>