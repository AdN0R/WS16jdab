<?php
	echo "<a href='./Layout.html'> Atzerantz</a>";
	$esteka = new mysqli("mysql.hostinger.es", "u361099527_u3610", "reportx9", "u361099527_quizz");
	
	$sen ="SELECT Galdera,Zailtasuna FROM galdera ORDER BY `Zenbakia` DESC";	
	$ema=$esteka->query($sen);
	
	echo "<b><center>Datuak</center></b><br><br>";
	for ($z = $ema->num_rows-1; $z>=0; $z--){
		$ema->data_seek($z);
		$l= $ema->fetch_assoc();
		$Galdera=$l['Galdera'];
		$Zailtasuna=$l['Zailtasuna'];
		echo"<br>$Galdera<br>$Zailtasuna<br><br><br>";
	}
	$esteka->close();
?>