<html>
	<?php
		$injury_URL = "http://www.fantasyfootballnerd.com/service/injuries/xml/2iacgnksv3vr/1/";
		$injury_data = file_get_contents($injury_URL);
		$data = simplexml_load_string($injury_data);
		//echo "<pre>"; print_r($data); exit; 
		echo "<ul>";
		$teamName = $data->Team[0]->code;
		echo "<li>$teamName</li>";
		/*foreach ($data->Team as $currentTeam) :
			$teamName = $currentTeam->code;
			echo "<li>$teamName</li>";
		endforeach;*/
		echo "</ul>";
	?>
</html>