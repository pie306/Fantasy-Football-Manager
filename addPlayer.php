<?php
		$weekNumber = 2;
		$position = $_POST['position'];
		$name = $_POST['playerName'];
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
		echo($count);
		/*$url = curl_init("http://www.fantasypros.com/nfl/rankings/wr.php#");
		curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
		$website = curl_exec($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($website);
		$titles = $dom->getElementsByTagName("a");
		$count = 0;
		foreach ($titles as $title) {
			if ($title->getAttribute("fp-player-name")) {
				$count++;
				if ($title->getAttribute("fp-player-name") == "A.J. Green") {
					break;
				}
			}
		}
		echo($count);*/
		/*
		$url = curl_init("http://espn.go.com/fantasy/football/story/_/page/14ranksWeek" . $weekNumber . "QB/fantasy-football-week-" . $weekNumber . "-fantasy-football-quarterback-rankings");
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
				if ($title->textContent == "Matt Cassel") {
					break;
				}
			}
		}
		echo($count);
		*/
	?>