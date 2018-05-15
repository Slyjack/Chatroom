<?php
	session_start();
	require 'db.php';
	$idChat = $_SESSION['idLastChat'];
	$a = "select c.idChat as id, c.time as time, u.username as username, c.value as chat, c.type as type
	from chat c join users u on u.idUsers=c.idUser 
	where c.idChat > $idChat";
	$sql = mysqli_query($conn, $a);
	if(mysqli_num_rows($sql) > 0) {
		while($row = mysqli_fetch_assoc($sql)){
			$_SESSION['idLastChat'] = $row['id'];
			if($row['type'] == 'system')
				echo $row['time'] . " " . $row['chat'] . "
";
			else if($row['type'] == 'user')
				echo $row['time'] . " " . $row['username'] . ": " . $row['chat'] . "
";
		}
	}
?>