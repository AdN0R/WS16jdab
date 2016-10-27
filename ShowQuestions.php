<?php
	echo "<a href='handlingQuizes.php'> Atzerantz</a>";
	$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
	
	$sen ="SELECT * FROM galdera ORDER BY `Zenbakia` DESC";	
	$ema=$esteka->query($sen);
	
	echo"<head><link rel='stylesheet' type='text/css' href='stylesPWS/style.css' /></head><body>";
	echo "<b><center>Datu-baseko datuak</center></b><br><br>";
	echo "<table style='width:100%'><tr><th>Zenbakia</th><th>Egilea</th><th>Gaia</th><th>Galdera</th><th>Erantzuna</th><th>Zailtasuna</th></tr>";
	for($z = $ema->num_rows-1; $z>=0; $z--){
		$ema->data_seek($z);
		$l= $ema->fetch_assoc();
		$Zenbakia=$l['Zenbakia'];
		$Egilea=$l['Egilea'];
		$Gaia=$l['Gaia'];
		$Galdera=$l['Galdera'];
		$Erantzuna=$l['Erantzuna'];
		$Zailtasuna=$l['Zailtasuna'];
		echo"<tr><td>$Zenbakia</td><td>$Egilea</td><td>$Gaia</td><td>$Galdera</td><td>$Erantzuna</td><td>$Zailtasuna</td></tr>";	
	}
	echo "</table></body>";
	$esteka->close();
?>