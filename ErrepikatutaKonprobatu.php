<?php
	if(isset($_GET[Errepika])){
		$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
		
		$sen ="SELECT * FROM erabiltzailea WHERE Eposta = '$_GET[Errepika]'";
		$ema=$esteka->query($sen);
		if(!$ema){
			die('Errorea: ' . $esteka->error);
			echo "<span style='color:red'>Errorea konexioan</span>";
		}
		else{
			$z = $ema->num_rows;
			if($z == 1){
				echo "EZ";
			}
			else{
				echo "BAI";
			}
		}
		$esteka->close();
	}
?>