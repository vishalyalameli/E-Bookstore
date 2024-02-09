<?php

	session_start();

	include("../includes/connection.php");

	if(!empty($_POST))
	{
		$_SESSION['error']=array();

		extract($_POST);

		if(empty($bnm))
		{
			$_SESSION['error']['bnm']="Enter Book Name";
		}

		if(empty($desc))
		{
			$_SESSION['error']['desc']="Enter Book Description";
		}

		if(empty($price))
		{
			$_SESSION['error']['price']="Enter Book Price";
		}
		else if(!is_numeric($price))
		{
			$_SESSION['error']['price']="Enter Book Price in Numbers";
		}

		if(empty($_FILES['b_img']['name']))
		{
			$_SESSION['error']['b_img'] = "Please provide a file";
		}
		else if($_FILES['b_img']['error']>0)
		{
			$_SESSION['error']['b_img'] = "Error uploading file";
		}
		else if(!(strtoupper(substr($_FILES['b_img']['name'],-4))==".JPG" || strtoupper(substr($_FILES['b_img']['name'],-5))==".JPEG"|| strtoupper(substr($_FILES['b_img']['name'],-4))==".GIF"))
		{
			$_SESSION['error']['b_img'] = "Wrong file type";
		}

		// Image validation

		if(!empty($_SESSION['error']))
		{
			header("Location: book_add.php");
			exit();
		}
		else
		{
			$t = time();
			$b_img = "book_img/".$_FILES['b_img']['name'];
			
			move_uploaded_file($_FILES['b_img']['tmp_name'], "../".$b_img);

			$q = "INSERT INTO book (b_nm, b_cat, b_desc, b_price, b_img, b_time) VALUES ('$bnm', $cat, '$desc', $price, '$b_img', $t)";

			$res = mysqli_query($link, $q);

			if($res)
			{
				header("Location: book_add.php");
				exit();
			}
			else
			{
				$_SESSION['error']['general'] = "Error adding the book. Please try again.";
				header("Location: book_add.php");
				exit();
			}
		}
	}
	else
	{
		header("Location: book_add.php");
		exit();
	}

?>
