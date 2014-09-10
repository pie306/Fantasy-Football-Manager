<html>
	<?php
		$injury_URL = "http://www.fantasyfootballnerd.com/service/injuries/xml/2iacgnksv3vr/1/";
		$injury_data = simplexml_load_file($injury_URL);
		//echo "<pre>"; print_r($data); exit; 
		/*$teamName = $injury_data->Teams->Team[0]['code'];
		echo "6";
		echo $teamName;*/
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
					echo "<li>$playerName $playerPosition $playerInjury $playerNotes</li>";
				}
			endforeach;
			echo "</ul></li>";
		endforeach;
		echo "</ol>";
	?>
</html>