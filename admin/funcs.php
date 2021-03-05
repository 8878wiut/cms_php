<?php

function confirmQuery($result) {
    
    global $connection;

    if (!$result) {
        die("Query Failed" . mysqli_error($connection));
    }
}

function insert_categories() {

    global $connection;

if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];

    if ($cat_title == "" || empty($cat_title)) {
        echo "<p style='color: red;'>Field should not be empty</p>";
    }
    else {
        $sql = "INSERT INTO categories(cat_title) VALUE ('$cat_title')";
        $query = mysqli_query($connection, $sql);

        if (!$query) {
            die("Query Failed" . mysqli_error($connection));
        }
    } 
}
}

function allCategories() {

    global $connection;

    $sql = "Select * From categories";
    $query_categories = mysqli_query($connection, $sql);      

       while ($row = mysqli_fetch_assoc($query_categories)) {
           $cat_id = $row['cat_id'];
           $cat_title = $row['cat_title'];
           echo "<tr>";
           echo "<td>{$cat_id}</td>";
           echo "<td>{$cat_title}</td>";
           echo "<td><a href='categories.php?delete={$cat_id}' style='color: red; text-decoration: none;'>Delete</a></td>";
           echo "<td><a href='categories.php?edit={$cat_id}' style='color: blue; text-decoration: none;'>Edit</a></td>";
           echo "</tr>";
       }
}

function deleteCategories() {
    
    global $connection;
    
    if (isset($_GET['delete'])) {
        $delete_cat_id = $_GET['delete'];

        $sql = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";
        $query_delete = mysqli_query($connection, $sql);
        header("Location: categories.php");
 }
    
}


?>