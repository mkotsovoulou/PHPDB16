<?php
require_once("inc/config.php");
include(ROOT_PATH . "inc/db.php");
$page_title = "ABC Co Login";
$page="login.php";
include(ROOT_PATH . "inc/header.php");
?>
<body>
<style>
    .formBorder {
        padding: 30px 15px;
        margin: 30px 5px;
        background-color: #f7f7f9;
        border: 1px solid #e1e1e8;
        border-radius: 4px;
    }
</style>
<?php include(ROOT_PATH . "inc/navigation.php"); ?>
    <div class="container">
        <div class="starter-template">
            <h1>Add Categories</h1>
            <?php //IF FORM IS SUBMITTED EXECUTE THE INSERT
               if (isset($_POST['addCategory'])) {
                   $try_category = $_POST['category'];
                   $output = addCategory($try_category);
                   echo "<H1>" . $output . "</H1";
               } else { // ELSE DISPLAY THE FORM
            ?>
        <div class="formBorder">
            <form class="form-horizontal" action="" method="POST">
            <div class="form-group">
                <label for="category" class="control-label col-xs-2">Category  Name</label>
                <div class="col-xs-10">
                <input type="text" id="category" name="category" class="form-control"/> 
                </div>
            </div>
            <div class="form-group">
                <button type="submit" id="addCategory" name="addCategory" value="Add Category" class="btn btn-primary">Add Category</button><br />
             </div>
            </form>
        </div>
        <br/>
        <?php } ?>
        </div> <!-- .starter-template -->
    </div><!-- .container -->

<?php include(ROOT_PATH . "inc/footer.php"); ?>

