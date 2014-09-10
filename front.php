<html>
	<?php
		$injuryListing = "http://www.fantasyfootballnerd.com/service/injuries/xml/2iacgnksv3vr/1/";
		if($response_xml_data){
			echo "read";
		}
		$data = simplexml_load_string($response_xml_data);
		echo "<pre>"; print_r($data); exit; 
	?>
</html>