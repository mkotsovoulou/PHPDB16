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

        <?php


        //IF FORM IS SUBMITTED EXECUTE THE INSERT
        if (isset($_POST['addCategory'])) {
            $try_category = $_POST['category'];
            $output = addCategory($try_category);
            echo "<H1>" . $output . "</H1>";
            unset($_POST['addCategory']);
        }

        $categories = get_categories();
        echo "<h1>View Categories</h1>";
        echo '<table class="table table-striped">';
        echo "<tr>";
        echo "<th> Category id</th>";
        echo "<th> Category Name</th>";
        echo "<th colspan='2'> Actions</th>";

        echo "</tr>";
        foreach ($categories as $category) { //loop though all rows
            //if Delete button was pressed and this is the row where the button is
            if (isset($_GET["delete"]) && $category["id"] == $_GET["id"]) {
                delete_category( $category["id"]);
                // echo "deleted " . $_GET["id"];
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageCategories.php">';
            }
            //if Save button was pressed and this is the row where the button is
            if (isset($_GET["save"]) && $category["id"] == $_GET["id"]) {
                update_category_name( $_GET["newName"] , $category["id"]);
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageCategories.php">';
                //echo "saved " . $_GET["id"];

            }
            echo '<form method="GET" >';
            echo "<tr>";
            echo "<td>" . $category["id"] . "</td>";
            //if Update button was pressed change the text to a textField
            if (isset($_GET['update']) && $category['id'] == $_GET['id'])
                echo '<td><input type="text" name="newName" id="newName" value="'. $category["cname"] . '"/></td>';
            else
             echo "<td>" . $category["cname"] . "</td>";

            //Change the button to say Update or Save
            if (isset($_GET['update']) && $category['id'] == $_GET['id'])
                echo '<td><button type="submit" name="save"> Save </button></td>';
            else if (!isset($_GET['update']))
                echo '<td><button type="submit" name="update"> Update </button></td>';

            echo '<td><button type="submit" name="delete"> Delete </button></td>';
            echo '<input type="hidden" name="id" value="' . $category["id"] . '"/>';
            echo "</tr>";
            echo "</form>";
        } //Loop through rows in categories array
     //   unset($_GET['update']);
     //   unset($_GET["save"]);
     //   unset($_GET["delete"]);
        echo  "</table>";
        ?>

        <h1>Add Categories</h1>

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
    </div> <!-- .starter-template -->
</div><!-- .container -->

<?php include(ROOT_PATH . "inc/footer.php"); ?>

