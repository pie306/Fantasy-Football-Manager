<html>
	<?php
		$injury_URL = "http://www.fantasyfootballnerd.com/service/injuries/xml/2iacgnksv3vr/1/";
		$injury_data = simplexml_load_file($injury_URL);
		//echo "<pre>"; print_r($data); exit; 
		echo "<ul>";
		$teamName = $injury_data;
		echo "<li>$teamName</li>";
		/*foreach ($data->Team as $currentTeam) :
			$teamName = $currentTeam->code;
			echo "<li>$teamName</li>";
		endforeach;*/
		echo "</ul>";
	?>
</html>