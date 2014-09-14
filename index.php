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
		  
			<?php
				} elseif(!empty($_POST['username']) && !empty($_POST['password'])) {
					$username = $_POST['username'];//mysqli_real_escape_string($_POST['username']);
					$password = $_POST['password'];//md5(mysqli_real_escape_string($_POST['password']));
					
					/*echo $username;
					echo "<br>";
					echo $password;
					echo "<br>";
					$username = mysqli_real_escape_string($_POST['username']);
					$password = md5(mysqli_real_escape_string($_POST['password']));
					echo $username;
					echo "<br>";
					echo $password;
					*/
					//$registerquery = mysqli_query("INSERT INTO users (Username, Password) VALUES('$username', '$password')");
					//echo $registerquery;
					/*if ($registerquery == true) {
						echo "success";
					} else {
						echo "failure"
					}
					*/
					$checklogin = mysqli_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
					if(mysqli_num_rows($checklogin) == 1) {
						$row = mysqli_fetch_array($checklogin);
						$_SESSION['Username'] = $username;
						$_SESSION['LoggedIn'] = 1;
						echo "<h1>Success</h1>";
						echo "<p>We are now redirecting you to your team.</p>";
						echo "<meta http-equiv='refresh' content='=2;index.php' />";
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