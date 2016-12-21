<?php
	$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
	
	$sen ="SELECT Argazkia FROM erabiltzailea WHERE Eposta LIKE 'jdiez030@ikasle.ehu.eus'";
	$ema=$esteka->query($sen);
	$z = $ema->num_rows;
	$ema->data_seek(1);
	$l= $ema->fetch_assoc();
	echo "<img width=100px src='data:image/jpeg;base64,".base64_encode($l['Argazkia'])."'/>";
?>