<?php
session_start();

include("../includes/connection.php");

$query = "DELETE FROM category WHERE cat_id =" . $_GET['id'];

$result = $link->query($query); // Use the query() method of the MySQLi object instead of mysql_query()

header("location:category_view.php");
?>
