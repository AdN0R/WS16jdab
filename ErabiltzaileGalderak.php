<?php
	session_start();
	if(isset($_SESSION[User]) && $_SESSION[Irakasle] == "EZ"){
		$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
		
		$sen ="SELECT * FROM galdera WHERE Egilea LIKE '$_SESSION[User]' ORDER BY `Zenbakia` DESC";	
		$ema=$esteka->query($sen);
		
		echo "<div id='container'><div class='col-md-offset-3 col-md-6'><table class='table-striped'>";
		echo "<thead><tr><th class='text-center'>Zenbakia</th><th class='text-center'>Egilea</th><th class='text-center'>Gaia</th><th class='text-center'>Galdera</th><th class='text-center'>Erantzuna</th><th class='text-center'>Zailtasuna</th></tr></thead><tbody>";
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
		echo "</tbody></table></div></div>";
		$esteka->close();
	}else{
		echo "<script>alert(\"Ikasle moduan Logeatu behar zara!\"); window.location = \"http://talde6.hol.es/Layout.php\";</script>";
	}
?>