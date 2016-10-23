<?php
	echo "<a href='InsertQuestion.php'> Atzerantz</a>";
	$esteka = new mysqli("mysql.hostinger.es", "u361099527_u3610", "reportx9", "u361099527_quizz");
	
	$sen ="SELECT * FROM galdera ORDER BY `Zenbakia` DESC";	
	$ema=$esteka->query($sen);
	
	echo "<b><center>Datuak</center></b><br><br>";
	echo "<table><tr><th>Zenbakia</th><th>Egilea</th><th>Materia</th><th>Galdera</th><th>Erantzuna</th><th>Zailtasuna</th></tr>"
	for ($z = $ema->num_rows-1; $z>=0; $z--){
		$ema->data_seek($z);
		$l= $ema->fetch_assoc();
		$Zenbakia=$l['Zenbakia'];
		$Egilea=$l['Egilea'];
		$Materia=$l['Materia'];
		$Galdera=$l['Galdera'];
		$Erantzuna=$l['Erantzuna'];
		$Zailtasuna=$l['Zailtasuna'];
		echo"<tr><td>$Zenbakia</td><td>$Egilea</td><td>$Materia</td><td>$Galdera</td><td>$Erantzuna</td><td>$Zailtasuna</td></tr>";	
	}
	echo "</table>"
	$esteka->close();
?>