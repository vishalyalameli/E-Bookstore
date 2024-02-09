<?php
session_start();
include("../includes/connection.php");

$query = "DELETE FROM book WHERE book_id =" . $_GET['id'];
$result = mysqli_query($link, $query);

if ($result) {
    header("Location: category_view.php");
    exit();
} else {
    echo "Error deleting book: " . mysqli_error($link);
}

mysqli_close($link);
?>
