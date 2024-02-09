<?php

	session_start();
	
	include("../includes/connection.php");

	$query = "DELETE FROM contact WHERE c_id = " . $_GET['id'];

	$result = mysqli_query($link, $query); // Replaced `mysql_query` with `mysqli_query`

	header("location:contact_view.php");

?>
