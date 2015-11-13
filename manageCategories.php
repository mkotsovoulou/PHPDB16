<?php
require_once("./inc/config.php");
echo ROOT_PATH;
include(ROOT_PATH . "inc/db.php");
$page_title = "ABC Co Home Page";
$page="manageCategories.php";
include(ROOT_PATH . "inc/header.php");
?>
<body>
<?php include(ROOT_PATH . "inc/navigation.php"); ?>
    <div class="container">
        <div class="starter-template">
    <?php if (isset($_SESSION ['admin']) && $_SESSION ['admin'] =="Y") { ?>
            <h1>Manage Categories</h1>
            <p class="lead">This is the manage categories page..</p>
    <?php } else { echo "Page does not exist!"; } ?>
    </div>
    </div><!-- /.container -->
<?php include(ROOT_PATH . "inc/footer.php"); ?>