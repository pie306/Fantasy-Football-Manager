<html>
	<?php
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
		/*$url = curl_init("http://www.numberfire.com/nfl/fantasy/fantasy-football-projections/wr");
		curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
		$website = curl_exec($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($website);
		$titles = $dom->getElementsByTagName("a");
		$count = 0;
		foreach ($titles as $title){
			if (preg_match("/Fantasy Projection$/", $title->getAttribute("title"))) {
				$count++;
				if ($title->getAttribute("title") == "A.J. Green Fantasy Projection") {
					break;
				}
			}
		}
		echo($count);*/
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
		$url = curl_init("http://espn.go.com/fantasy/football/story/_/page/14ranksWeek2WR/fantasy-football-week-2-fantasy-football-wide-receiver-rankings");
		curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
		$website = curl_exec($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($website);
		$titles = $dom->getElementsByTagName("a");
		$count = 0;
		foreach ($titles as $title) {
			if ($title->getAttribute("playeridtype") == "sportsId") {
				$count++;
				if ($title->textContent == "A.J. Green") {
					break;
				}
			}
		}
		echo($count);
	?>
</html>
