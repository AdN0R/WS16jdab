<?php
	echo "<a href='SignUp.html'> Atzerantz</a>";
	$esteka = new mysqli("mysql.hostinger.es", "u361099527_u3610", "reportx9", "u361099527_quizz");
	
	$sen ="SELECT * FROM erabiltzailea";	
	$ema=$esteka->query($sen);
	
	echo "<b><center>Datuak</center></b><br><br>";
	for ($z = $ema->num_rows-1; $z>=0; $z--){
		$ema->data_seek($z);
		$l= $ema->fetch_assoc();
		$Izena=$l['Izena'];
		$Abizena1=$l['Abizena1'];
		$Abizena2=$l['Abizena2'];
		$Eposta=$l['Eposta'];
		$Pasahitza=$l['Pasahitza'];
		$Telefonoa=$l['Telefonoa'];
		$Espezialitatea=$l['Espezialitatea'];
		$Teknologiak=$l['InteresekoTeknologia'];
		$Erremintak=$l['InteresekoErremintak'];
		echo"<b>$Izena $Abizena1 $Abizena2</b>
		<br>$Eposta<br>$Pasahitza<br>$Telefonoa<br>$Espezialitatea<br>$Teknologiak<br>$Erremintak<br><br><br>";
	}
	$esteka->close();
?>