<?php
function update_category_name($newName, $id) {
    require(ROOT_PATH . "inc/db.php");
    try {
        $results = $db->prepare("update categories set cname=? where id=?");
        $results -> bindParam (1, $newName);
        $results -> bindParam (2, $id);
        $results -> execute();
    }catch (PDOException $e) {
        echo "error updating category : " . $e;
    }
}

function delete_category($id) {
    require(ROOT_PATH . "inc/db.php");
    try {
        $results = $db->prepare("delete from categories where id =?");
        $results -> bindParam (1, $id);
        $results -> execute();
    }catch (PDOException $e) {
        echo "error deleting category : " . $e;
    }

}

function addCategory($categoryName) {
    require(ROOT_PATH . "inc/db.php");
    try {
        $stmt =
            $db->prepare("insert into categories (cname) VALUES (?)");
        $stmt->bindParam(1, $categoryName, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count>0) return "Category added ";
        else return "Error adding category.";
    } catch (PDOException $e) {
        echo "some insert error..." ;
    }
}


function get_all_products () {
    require(ROOT_PATH . "inc/db.php");
    try {
        $results = $db->query ("SELECT pname, price, image, description, cname
                                FROM categories, products
                                WHERE products.category_id = categories.id");
    } catch (PDOException $e) {
        echo "error selecting products" . $e;
    }
    $products_array = $results->fetchAll (PDO::FETCH_ASSOC);
    return $products_array;
}

//Change the limit to retrieve more than 4 latest products
function get_latest_products () {
    require(ROOT_PATH . "inc/db.php");
    try {
        $results = $db->query ("SELECT pname, price, image, description, cname
                                FROM categories, products
                                WHERE products.category_id = categories.id
                                ORDER BY date_added DESC
                                LIMIT 4");
    } catch (PDOException $e) {
        echo "error selecting products" . $e;
    }
    $products_array = $results->fetchAll (PDO::FETCH_ASSOC);
    return $products_array;
}

function get_all_categories() {
    require(ROOT_PATH . "inc/db.php");
    try {
        $results = $db->query ("SELECT cname, id FROM categories ORDER BY cname ASC");

    } catch (PDOException $e) {
        echo "error selecting categories" . $e;
    }

    $categories_array = $results->fetchAll (PDO::FETCH_ASSOC);
    return $categories_array;
}

function get_categories() {
    require(ROOT_PATH . "inc/db.php");
    try {
        $results = $db->query ("SELECT cname, id FROM categories ORDER BY id ASC");

    } catch (PDOException $e) {
        echo "error selecting categories" . $e;
    }

    $categories_array = $results->fetchAll (PDO::FETCH_ASSOC);
    return $categories_array;
}
function get_products_by_category ($category_id) {
    require(ROOT_PATH . "inc/db.php");
    try {
        $results = $db->prepare ("SELECT pname, price, image, description, cname
                                  FROM categories, products
                                  WHERE products.category_id = categories.id
                                  AND categories.id = ?");

        $results -> bindParam (1, $category_id);
        $results -> execute();
    } catch (PDOException $e) {
        echo "error selecting products" . $e;
    }

    $products_array = $results->fetchAll (PDO::FETCH_ASSOC);
    return $products_array;
}

function search ($search) {
    require(ROOT_PATH . "inc/db.php");
    $search = strtoupper($search);
    try {
        $results = $db->prepare ("SELECT pname, price, image, description, cname
                                    FROM categories, products
                                    WHERE products.category_id = categories.id
                                    AND (UPPER(pname) LIKE ? OR UPPER(description) LIKE ?) ");
        $search = "%" . $search . "%";
        $results -> bindParam (1, $search);
        $results -> bindParam (2, $search);
        $results -> execute();
    } catch (PDOException $e) {
        echo "Search Error" . $e;
    }

    $products_array = $results->fetchAll (PDO::FETCH_ASSOC);
    return $products_array;
}
?>