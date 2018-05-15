<?php
	require 'db.php';
	$user = mysqli_real_escape_string($conn, $_POST['user']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	$a = "select * from users where username = lower('$user')
			and password = lower('$pass')";
	$sql = mysqli_query($conn, $a);

	if(mysqli_num_rows($sql) == 1) {
		$row = mysqli_fetch_assoc($sql);
		$idUser = $row['idUsers'];
		$_SESSION['username'] = $row['Username'];
		$_SESSION['usertype'] = $row['UserType'];
		$_SESSION['idUser'] = $row['idUsers'];
		$_SESSION['idLastChat'] = 0;
		$a = "update users set Online = '1' where idUsers = '$idUser'";
		$online = mysqli_query($conn, $a);
		$time = date('H:i:s');
		$a = "insert into chat (idUser, Value, Time, Type) values ($idUser, '$user joined', '$time', 'system')";
		$joined = mysqli_query($conn, $a);
		header("Location:index.php");
	}
	else {
		header("Location:index.php");
		exit;
	}
/*		echo	"User:	" . $_POST['user'] . "<br>" . 
				"Pass:	" . $_POST['pass'] . "<br>" . 
				"User:	" . $user . "<br>" . 
				"Pass:	" . $pass . "<br>" . 
				$a;
*/
?>