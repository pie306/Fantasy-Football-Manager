<!DOCTYPE html>
<html>  
	<head>  
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
		<title>Fantasy Football Manager</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>  
	<body>  
		<div id="main">
			<?php
				include "base.php";
				if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
			?>
					<h1>Login</h1>
					<p>Thanks for logging in! Hello <code><?=$_SESSION['Username']?></code>.</p>
					<br>
					<br>
					<table style="width:100%">
						<tr>
							<td>Player</td>
							<td>Positon</td>
							<td>NumberFire Rank</td>
							<td>FantasyPros Rank</td>
							<td>ESPN Rank</td>
						</tr>
						<?php
						$result = mysqli_query($success, "SELECT * FROM players WHERE Username = '$username'");
						$team = mysql_fetch_row($result);
						for ($i = 1; $i < 17; $i++) {
							echo "<tr><td>";
							$currentPlayer = $team[$i];
							echo $currentPlayer;
							echo "</td></tr>";
						}
						?>
					</table>
					<br>
					<br>
					<form method="post" action="addPlayer.php" name="loginform" id="loginform">
						<fieldset>
							<label for="playerName">Player Name:</label><input type="text" name="playerName" id="playerName" /><br />
							<label for="position">Position:</label><input type="text" name="position" id="position" /><br />
							<input type="submit" name="add" id="add" value="Add" />
						</fieldset>
					</form>
					<form method="post" action="logout.php" name="logoutform" id="logoutform">
						<fieldset>
							<input type="submit" name="logout" id="logout" value="Logout" />
						</fieldset>
					</form>
			<?php
				} elseif(!empty($_POST['username']) && !empty($_POST['password'])) {
					$username = mysqli_real_escape_string($success, $_POST['username']);
					$password = md5(mysqli_real_escape_string($success, $_POST['password']));
					$checklogin = mysqli_query($success, "SELECT * FROM users WHERE Username = '$username' AND Password = '$password'");
					if(mysqli_num_rows($checklogin) == 1) {
						$row = mysqli_fetch_array($checklogin);
						$_SESSION['Username'] = $_POST['username'];
						$_SESSION['LoggedIn'] = 1;
						echo "<h1>Success</h1>";
						echo "<p>We are now redirecting you to your team.</p>";
						echo "<meta http-equiv='refresh' content='2' />";
					} else if (mysqli_num_rows(mysqli_query($success, "SELECT * FROM users WHERE Username = '$username'")) == 1) {
						echo "<h1>Error</h1>";
						echo "<p>Incorrect Password. Please <a href=\"index.php\">click here to try again</a>.</p>";
					} else {
						echo "<h1>Error</h1>";
						echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
					}
				} else {
			?>
					<h1>Account Login</h1>
					<p>Login below, or <a href="register.php">click here to register</a>.</p>
					<form method="post" action="index.php" name="loginform" id="loginform">
						<fieldset>
							<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
							<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
							<input type="submit" name="login" id="login" value="Login" />
						</fieldset>
					</form>
			<?php
				}
			?>
		</div>
	</body>
</html>