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
		$url = curl_init("https://www.youtube.com/");
		curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
		$website = curl_exec($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($website);
		$title = $dom->getElementById("browse-items-primary");
		echo "<pre>";
		print_r($title);
		//$output = file_get_contents($url); 
		//echo $output;
	?>
</html>
