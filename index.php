<?php
	session_start();
	require 'db.php';
	echo "
	<!DOCTYPE html>
	<html>
		<head>
			<title>Chatroom</title>
			<script src='https://code.jquery.com/jquery-3.2.1.js' integrity='sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE='  crossorigin='anonymous'></script>
			<script src='js.js'></script>
			<style>
				html, body {
					height: 90%;
					background-color: gray;
				}
				header {
					font-size:	20px;
				}
				#main {
					display:			flex;
					flex-direction:		column;
					width:				75%;
					height:				90%;
					margin:				auto;
				}
				#header {
					display:			flex;
					flex-direction:		row;
					justify-content:	space-between;
					width:				auto;
					margin:				10px 0 10px 0;
					padding:			10px;
					border:				1px solid black;
					background-color:	white;
				}
				#body {
					display:		flex;
					flex-direction:	row;
					width:			100%;
					height:			100%;
				}
				#users {
					background-color:	white;
					width:				100px;
					margin-right:		10px;
					border:				1px solid black;
					padding:			10px;
				}
				#chat {
					display:			flex;
					flex-direction:		column;
					width:				100%;
					border:				1px solid black;
					padding:			10px;
					background-color:	white;
				}
				#output {
					flex:			1;
					border: 		1px solid black;
					margin-bottom:	10px;
				}
				#input {
					height:	20px;
				}
				#sendform {
					display:	flex;
					flex-direction:	row;					
				}
				#sendtext {
					flex:		1;
				}
				#button {
					background-color:	#e7e7e7;
					color:				black;
					border:				none;
					text-align:			center;
					text-decoration:	none;
					display:			inline-flex;
					font-size:			16px;
					padding:			5px 3px;
					border-radius:		4px;
					transition-duration: 0.4s;
					-webkit-transition-duration: 0.4s; /* Safari */
				}
				#button:hover {
					background-color: #000000;
					color: white;
				}
				textarea{
					height:	100%;
					width:	100%;
					resize:	none;
					box-sizing:			border-box;	/* Opera/IE 8+ */
				   -webkit-box-sizing:	border-box;	/* Safari/Chrome, other WebKit */
					-moz-box-sizing:	border-box;	/* Firefox, other Gecko */
				}
			</style>
		</head>
		<body>";
	if(!isset($_SESSION['idUser'])){
		echo "
			<div id='main' style='text-align: center;'>
				<table style='margin: auto;'>
					<form method='post' action='login.php'>
						<tr>
							<td>Username:</td>
							<td><input type='text' placeholder='Username' name='user'></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type='password' placeholder='*********' name='pass'></td>
						</tr>
						<tr>
							<td></td>
							<td><input type='submit' name='login'></td>
						</tr>
					</form>
				</table>
			</div>";
	}
	else {
		echo "
			<div id='main'>
				<div id='header'>
					<header>Logged in as " . $_SESSION['username'] . ".</header>
					<button id='button' type='submit' onclick='window.location.href=\"logout.php\"' />Logout</button>
				</div>
				<div id='body'>
					<div id='users'>
						<table>";
		$a = "select * from users where online = 1";
		$sql = mysqli_query($conn, $a);
		if(mysqli_num_rows($sql) > 0 && mysqli_num_rows($sql) < 30) {
			while($row = mysqli_fetch_assoc($sql)){
				$user = $row['Username'];
				echo "
							<tr><td>$user</td></tr>";
			}
		}
		echo "
						</table>
					</div>
					<div id='chat'>
						<div id='output'>
							<textarea readonly id='chatbox'></textarea>
						</div>
						<div id='input'>
							<form id='sendform' onsubmit='event.preventDefault(); send()'>
								<input type='text' name='chat' id='sendtext'>
								<input type='submit' value='Say' id='sendbutton'>
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