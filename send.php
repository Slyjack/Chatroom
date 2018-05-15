<?php
	session_start();
	require 'db.php';
	$chat = $_GET['chat'];
	$idUser = $_SESSION['idUser'];
	$time = date('H:i:s');
	$a = "insert into chat (idUser, Value, Time) values ($idUser, '$chat', '$time')";
	$online = mysqli_query($conn, $a)or die(mysqli_error($conn));;
	header("Location:index.php");
?>