<?php
session_start();

if (!empty($_POST)) {
    extract($_POST);
    $_SESSION['error'] = array();

    if (empty($cat)) {
        $_SESSION['error'][] = "Please enter Category Name";
        header("location:category_edit.php?id=$id");
    } else {
        include("../includes/connection.php");

        $q = "UPDATE category SET cat_nm='$cat' WHERE cat_id=$id";

        $result = mysqli_query($link, $q); // Use the mysqli_query() function with the connection object

        header("location:category_view.php");
    }
} else {
    header("location:category_view.php");
}
?>
