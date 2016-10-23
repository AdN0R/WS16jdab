<?php
	$xml = simplexml_load_file('galderak.xml','SimpleXMLElement', LIBXML_NOWARNING);
	if (!$xml){
		echo '<script>alert("Errorea XML txertaketan")</script>';
		exit;
	}
	echo"<head><link rel='stylesheet' type='text/css' href='stylesPWS/style.css' /></head><body>";
	echo "<a href='InsertQuestion.php'> Atzerantz</a>";
	echo "<b><center>XML fitxategiko datuak</center></b><br><br>";
	echo "<table style='width:100%'><tr><th>Galdera</th><th>Konplexutasuna</th><th>Gaia</th></tr>";
	foreach($xml->children() as $assessmentItem){
		foreach($assessmentItem->children() as $umea){
			if($umea->getName()=='itemBody'){
				foreach($umea->children() as $umea2){
					if($umea2->getName()=='p'){
						echo "<tr><td>" . $umea2 . "</td>";
					}
				}
			}
		}
		echo "<td>" . $assessmentItem['complexity'] . "</td>";
		echo "<td>" . $assessmentItem['subject'] . "</td></tr>";
	}
	echo "</table></body>";
?>