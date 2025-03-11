<?php
/* Array of pages, each will add Nav button along with path */
/* NEEDS TO BE INSIDE VIEWS */
$pages = [
    'departments',
    'employees',
    'projects'
];
?>

<nav>
    <ul>
        <li>
            <a href="<?= BASE_URL ?>">Home</a>
        </li>
        <?php
        foreach ($pages as $page) {
            echo '<li>';
            echo '<a href="' . BASE_URL . '/views/' . $page . '">' . $page . '</a>';
            echo '</li>';
        };
        ?>
    </ul>

</nav>