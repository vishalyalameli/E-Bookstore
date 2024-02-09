<?php
	session_start();
	
	include("../includes/connection.php");

	$query = "DELETE FROM register WHERE r_id = ".$_GET['id'];

	$result = mysqli_query($link, $query);

	if ($result) {
		header("location: users_view.php");
		exit;
	} else {
		echo "Error: " . mysqli_error($link);
	}

	mysqli_close($link);
?>
