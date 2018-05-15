<?php
	require 'db.php';
	$a = "select * from users where online = 1";
	$sql = mysqli_query($conn, $a);
	if(mysqli_num_rows($sql) > 0 && mysqli_num_rows($sql) < 30) {
		while($row = mysqli_fetch_assoc($sql)){
			$user = $row['Username'];
			echo "
							<tr><td>$user</td></tr>";
		}
	}
?>