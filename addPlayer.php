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
			if ($i == NULL) {
				break;
			}
		}
		if ($i != 17) {
			$_SESSION['i'] = $i;
			//$playerNum = "Player" . $i;
			//mysqli_query($success, "SET SQL_SAFE_UPDATES=0");
			//mysqli_query($success, "UPDATE players SET $playerNum = '$playerName' WHERE Username = '$user'");
			//mysqli_query($success, "INSERT INTO positions (Username, Player, Position) VALUES('$usern', '$playerName', '$position')");
		}
		header("Location: index.php");
		
		/*$weekNumber = 2;
		$position = $_POST['position'];
		$name = $_POST['playerName'];
		echo($name . ": ");
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
		/*$injury_URL = "http://www.fantasyfootballnerd.com/service/injuries/xml/2iacgnksv3vr/2/";
		$injury_data = simplexml_load_file($injury_URL);
		echo "<ol>";
		foreach ($injury_data->Teams->Team as $currentTeam) :
			$teamName = $currentTeam['code'];
			echo "<li>$teamName<ul>";
			foreach ($currentTeam->Player as $player) :
				if ($player['gameStatus'] == "Out") {
					$playerName = $player['playerName'];
					$playerPosition = $player['position'];
					$playerInjury = $player['injury'];
					$playerNotes = $player['notes'];
					echo "<li>$playerName ($playerPosition), $playerInjury, $playerNotes</li>";
				}
			endforeach;
			echo "</ul></li>";
		endforeach;
		echo "</ol>";*/
		/*$originalURL = "http://www.numberfire.com/nfl/fantasy/fantasy-football-projections/" . $position;
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
	?>