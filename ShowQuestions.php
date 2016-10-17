<?php
	echo "<a href='InsertQuestion.php'> Atzerantz</a>";
	$esteka = new mysqli("mysql.hostinger.es", "u361099527_u3610", "reportx9", "u361099527_quizz");
	
	$sen ="SELECT * FROM galdera";	
	$ema=$esteka->query($sen);
	
	echo "<b><center>Datuak</center></b><br><br>";
	for ($z = $ema->num_rows-1; $z>=0; $z--){
		$ema->data_seek($z);
		$l= $ema->fetch_assoc();
		$Zenbakia=$l['Zenbakia'];
		$Egilea=$l['Egilea'];
		$Galdera=$l['Galdera'];
		$Erantzuna=$l['Erantzuna'];
		$Zailtasuna=$l['Zailtasuna'];
		echo"<b>$Zenbakia $Egilea</b>
		<br>$Galdera<br>$Erantzuna<br>$Zailtasuna<br><br><br>";	}
	$esteka->close();
?>