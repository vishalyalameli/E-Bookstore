<?php
	session_start();

	if(isset($_GET['bcid']))
	{
		include("includes/connection.php");

		$q="SELECT * FROM book WHERE b_id=".$_GET['bcid'];

		$res=mysqli_query($link, $q);

		if($res) {
			$row=mysqli_fetch_assoc($res);
			$_SESSION['cart'][]=array("nm"=>$row['b_nm'],"img"=>$row['b_img'],"price"=>$row['b_price'],"qty"=>1);
		} else {
			// Handle the query error
			echo "Error executing the query: " . mysqli_error($link);
		}
	}

	else if(!empty($_POST))
	{
		foreach($_POST as $id=>$qty)
		{
			$_SESSION['cart'][$id]['qty']=$qty;
		}
	}

	else if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		unset($_SESSION['cart'][$id]);
	}

	header("location:cart.php");
?>
