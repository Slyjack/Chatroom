<?php
	require 'db.php';
	$a = "delete from chat";
	$online = mysqli_query($conn, $a)or die(mysqli_error($conn));;
	header("Location:index.php");
?>