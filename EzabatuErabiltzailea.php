<?php
	$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
			
	$sql = "DELETE FROM erabiltzailea WHERE Eposta LIKE '$_GET[Eposta]'";	
	if(!$esteka->query($sql)){
		die("$Errorea: " . $esteka->error);		
	}

	$esteka->close();
	echo "<script>alert('Erregistro bat ezabatu da!');window.location = \"./Erabiltzaileak.php\";</script>";
?>