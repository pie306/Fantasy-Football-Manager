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
					<h1>Your Account</h1>
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
						$username = $_SESSION['Username'];
						$teamSearch = "SELECT * FROM players WHERE Username = '$username'";
						//echo $teamSearch;
						$result = mysqli_query($success, $teamSearch);
						$team = mysqli_fetch_row($result);
						$weekNumber = 3;
						echo ($_SESSION['i']);
						for ($i = 1; $i < 17; $i++) {
							$currentPlayer = $team[$i];
							$positionSearch = "SELECT * FROM positions WHERE Username = '$username' AND Player = '$currentPlayer'";
							//echo $teamSearch;
							$positionResult = mysqli_query($success, $positionSearch);
							$positions = mysqli_fetch_row($positionResult);
							//print_r($result);*/
							echo "<tr><td>";
							$currentPlayer = $team[$i];
							echo $currentPlayer;
							echo "</td><td>";
							echo $positions[2];
							echo "</td>";
							$playerInjury = false;
							$injury_URL = "http://www.fantasyfootballnerd.com/service/injuries/xml/2iacgnksv3vr/ . $weekNumber ./";
							$injury_data = simplexml_load_file($injury_URL);
							foreach ($injury_data->Teams->Team as $currentTeam) :
								$teamName = $currentTeam['code'];
								foreach ($currentTeam->Player as $player) :
									if ($player['playerName'] == $currentPlayer && strcasecmp($player['position'], $positions[2]) == 0 && ($player['gameStatus'] == "Out" 
										|| $player['gameStatus'] == 'Questionable')) {
										$playerInjuryDetails = $player['injury'];
										$playerStatus = $player['gameStatus'];
										$playerNotes = $player['notes'];
										$playerInjury = true;
									}
								endforeach;
							endforeach;
							if ($currentPlayer != NULL && $playerInjury == false) {
								echo "<td>";
								$position = $positions[2];
								$name = $currentPlayer;
								if ($position == "qb") {
									$espnURL = "http://espn.go.com/fantasy/football/story/_/page/14ranksWeek" . $weekNumber . "QB/fantasy-football-week-" . $weekNumber . "-fantasy-football-quarterback-rankings";
								} else if ($position == "rb") {
									$espnURL = "http://espn.go.com/fantasy/football/story/_/page/14ranksWeek" . $weekNumber . "RB/fantasy-football-week-" . $weekNumber . "-fantasy-football-running-back-rankings";
								} else if ($position == "wr") {
									$espnURL = "http://espn.go.com/fantasy/football/story/_/page/14ranksWeek" . $weekNumber . "WR/fantasy-football-week-" . $weekNumber . "-fantasy-football-wide-receiver-rankings";
								} else if ($position == "te") {
									$espnURL = "http://espn.go.com/fantasy/football/story/_/page/14ranksWeek" . $weekNumber . "TE/fantasy-football-week-" . $weekNumber . "-fantasy-football-tight-end-rankings";
								} else if ($position == "k") {
									$espnURL = "http://espn.go.com/fantasy/football/story/_/page/14ranksWeek" . $weekNumber . "K/fantasy-football-week-" . $weekNumber . "-fantasy-football-kicker-rankings";
								} else if ($position == "d") {
									$espnURL = "http://espn.go.com/fantasy/football/story/_/page/14ranksWeek" . $weekNumber . "DST/fantasy-football-week-" . $weekNumber . "-fantasy-football-defense-special-teams-rankings";
								}
								
								$originalURL = "http://www.numberfire.com/nfl/fantasy/fantasy-football-projections/" . $position;
								$url = curl_init($originalURL);
								curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
								$website = curl_exec($url);
								$dom = new DOMDocument();
								@$dom->loadHTML($website);
								$titles = $dom->getElementsByTagName("a");
								$count = 0;
								foreach ($titles as $title){
									if (preg_match("/Fantasy Projection$/", $title->getAttribute("title"))) {
										$count++;
										if ($title->getAttribute("title") == $name . " Fantasy Projection") {
											break;
										}
									}
								}
								echo($count . " ");
								echo "</td><td>";
								if ($position == "d") {
									$position = "dst"; 
								}
								$url = curl_init("http://www.fantasypros.com/nfl/rankings/" . $position .".php#");
								curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
								$website = curl_exec($url);
								$dom = new DOMDocument();
								@$dom->loadHTML($website);
								$titles = $dom->getElementsByTagName("a");
								$count = 0;
								foreach ($titles as $title) {
									if ($title->getAttribute("fp-player-name")) {
										$count++;
										if ($title->getAttribute("fp-player-name") == $name) {
											break;
										}
									}
								}
								echo($count . " ");
								echo "</td><td>";
								$url = curl_init($espnURL);
								curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
								$website = curl_exec($url);
								$dom = new DOMDocument();
								@$dom->loadHTML($website);
								$titles = $dom->getElementsByTagName("a");
								$started = false;
								$count = 0;
								foreach ($titles as $title) {
									if (preg_match("/Week 2$/", $title->textContent)) {
										$started = true;
									} else if ($started == true) {
										$count++;
										if ($title->textContent == $name) {
											break;
										}
									}
								}
								echo($count);
								echo"</td>";
							} else if ($playerInjury == true){
								echo "<td>$playerStatus</td><td>$playerInjuryDetails</td><td>$playerNotes</td>";
								
							}
							echo "</tr>";
						}
						?>
					</table>
					<br>
					<br>
					<form method="post" action="addPlayer.php" name="loginform" id="loginform">
						<fieldset>
							<label for="playerName">Player Name:</label><input type="text" name="playerName" id="playerName" /><br />
							<label for="position">Position:</label>
							<select id="position" name="position">
								<option value="na">Position</option>
								<option value="qb">Quarterback</option>
								<option value="rb">Runningback</option>
								<option value="wr">Wide Receiver</option>
								<option value="te">Tight End</option>
								<option value="d">Defense</option>
								<option value="k">Kicker</option>
							</select><br />
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
					if(mysqli_num_rows($checklogin) >= 1) {
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