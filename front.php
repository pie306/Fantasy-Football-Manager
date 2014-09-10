<html>
	<?php
		$injury_URL = "http://www.fantasyfootballnerd.com/service/injuries/xml/2iacgnksv3vr/1/";
		$injury_data = file_get_contents($injury_URL);
		if($injury_data){
			echo "read";
		}
		$data = simplexml_load_string($injury_data);
		echo "<pre>"; print_r($data); exit; 
	?>
</html>