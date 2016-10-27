<?php
	echo "<a href='./Layout.html'> Atzerantz</a>";
	$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
	
	$sen ="SELECT Galdera,Zailtasuna FROM galdera ORDER BY `Zenbakia` DESC";	
	$ema=$esteka->query($sen);
	
	echo"<head><link rel='stylesheet' type='text/css' href='stylesPWS/style.css' /></head><body>";
	echo "<b><center>Datu-baseko datuak</center></b><br><br>";
	echo "<table style='width:100%'><tr><th>Galdera</th><th>Zailtasuna</th></tr>";
	for ($z = $ema->num_rows-1; $z>=0; $z--){
		$ema->data_seek($z);
		$l= $ema->fetch_assoc();
		$Galdera=$l['Galdera'];
		$Zailtasuna=$l['Zailtasuna'];
		echo"<tr><td>$Galdera</td><td>$Zailtasuna</td></tr>";
	}
	echo "</table></body>";
	$esteka->close();
?>