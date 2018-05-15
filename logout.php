<?php
	require 'db.php';
	$idUser = $_SESSION['idUser'];
	$a = "update users set Online = '0' where idUsers = '$idUser'";
	$online = mysqli_query($conn, $a);
	$a = "select Username from users where idUsers = '$idUser'";
	$sql = mysqli_query($conn, $a);
	if(mysqli_num_rows($sql) == 1){
		$row = mysqli_fetch_assoc($sql);
		$user = $row['Username'];
	}
	$time = date('H:i:s');
	$a = "insert into chat (idUser, Value, Time, Type) values ($idUser, '$user left', '$time', 'system')";
	$left = mysqli_query($conn, $a);
	session_unset();
	session_destroy();
	header("Location:index.php");
	exit;
?>