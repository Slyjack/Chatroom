<?php
	require 'db.php';
	echo "
	<!DOCTYPE html>
	<html>
		<head>
			<title>Chatroom</title>
			<link rel='stylesheet' type='text/css' href='style.css'>
			<script src='https://code.jquery.com/jquery-3.2.1.js' integrity='sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE='  crossorigin='anonymous'></script>
			<script src='js.js'></script>
			<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
		</head>
		<body>";
	if(!isset($_SESSION['idUser'])){
		echo "
			<div id='main'>
				<table id='login'>
					<form method='post' action='login.php'>
						<tr>
							<td>Username:</td>
							<td><input type='text' placeholder='Username' name='user' autofocus required></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type='password' placeholder='*********' name='pass' required></td>
						</tr>
						<tr>
							<td></td>
							<td><input type='submit' name='login' id='loginbutton'></td>
						</tr>
					</form>
				</table>
			</div>";
	}
	else {
		$a = "select UserType from users where idUsers = " . $_SESSION['idUser'];
		$sql = mysqli_query($conn, $a);
		$row = mysqli_fetch_assoc($sql);
		echo "
			<div id='main'>
				<div id='header'>
					<header>Logged in as " . $_SESSION['username'] . ".</header>";
		if($row['UserType'] == 1)
			echo "
					<div class='buttongroup'>
						<button id='adminbutton' type='submit' onclick='window.location.href=\"clear.php\"' />CLEAR CHAT</button>
						<button id='adminbutton' type='submit' onclick='window.location.href=\"users.php\"' />MANAGE USERS</button>
						<button id='adminbutton' type='submit' onclick='window.location.href=\"logout.php\"' />LOGOUT</button>
					</div>";
		else
			echo "
					<button id='button' type='submit' onclick='window.location.href=\"logout.php\"'>LOGOUT</button>";
		echo "
				</div>
				<div id='body'>
					<div id='users'>
						<table id='usertable'>
						</table>
					</div>
					<div id='chat'>
						<div id='output'>
							<textarea readonly id='chatbox'></textarea>
						</div>
						<div id='input'>
							<form id='sendform' onsubmit='event.preventDefault(); send()'>
								<input type='text' name='chat' id='sendtext'>
								<input type='submit' value='SEND' id='sendbutton'>
							</form>
						</div>
					</div>
				</div>
			</div>";
	}

	echo "
		</body>
	</html>";
?>