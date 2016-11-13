<?php
	session_start();
	if(isset($_SESSION[User]) && $_SESSION[Irakasle] == "BAI"){
		$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
		$sen ="UPDATE `galdera` SET `Gaia`='$_POST[Gaia]',`Galdera`='$_POST[Galdera]',`Erantzuna`='$_POST[Erantzuna]',`Zailtasuna`='$_POST[Zailtasuna]' WHERE `Zenbakia`='$_COOKIE[gZb]'";
		if(!$esteka->query($sen)){
			die('Errorea: ' . $esteka->error);		
		}
		
		echo "<p> Aldaketa egin da datu basean. </p>";
		echo "<p> <a href='reviewingQuizzes.php'> Jarraitu </a> </p>";
		
		$esteka->close();
		
	}else{
		echo "<p> Irakasle moduan logeatu behar zara </p>";
	}
	
?>