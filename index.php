<?php
/* Includes path, giving access to Header, Footer & Nav */
require_once 'initialise.php';

/* Page title shown in browser tab */
$pageTitle = 'Front Page';

/* includes the files from ROOT_PATH */
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';
    
?>
<main>
    <p>EEE Some long ... text here or something like that or u know lorem whatever</p>
</main>

<?php include_once ROOT_PATH . '/public/footer.php'; ?>