<?php
		include "base.php";
		$playerName = mysqli_real_escape_string($success, $_POST['playerName']);
		$position = mysqli_real_escape_string($success, $_POST['position']);
		$user = mysqli_real_escape_string($success, $_SESSION['Username']);
		$teamSearch = "SELECT * FROM players WHERE Username = '$user'";
		//echo $teamSearch;
		$result = mysqli_query($success, $teamSearch);
		$team = mysqli_fetch_row($result);
		for ($i = 1; $i < 17; $i++) {
			if ($team[$i] == $playerName) {
				break;
			}
		}
		if ($i != 17) {
			$playerNum = "Player" . $i;
			mysqli_query($success, "SET SQL_SAFE_UPDATES=0");
			mysqli_query($success, "UPDATE players SET $playerNum = NULL WHERE Username = '$user'");
			mysqli_query($success, "DELETE FROM positions WHERE Username = '$user' AND Player = '$playerName' AND Position = '$position'");
		}
		header("Location: index.php");
		
		
	?>