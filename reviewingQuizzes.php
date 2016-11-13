<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Quizzes</title>
		<link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='stylesPWS/wide.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='stylesPWS/smartphone.css' />
		
		<script src="JS.js"></script>
		<script type="text/javascript" language="javascript" >
			
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if((xhttp.readyState==4)&&(xhttp.status==200)){
					document.getElementById("galdiv").innerHTML=xhttp.responseText;
					}
			};
			function galIku(){
				document.getElementById("txertatu").innerHTML= "";
				xhttp.open("GET","ErabiltzaileGalderak.php", true);
				xhttp.send();
			}
			
			function aldatu(zbk){
				document.cookie = "gZb="+zbk;
				window.location = "http://wsjdab.esy.es/editQuestion.php";
			}
			
		</script>
	</head>
	<body id="rqBody">
		<center>
			<br /><h2>Aukeratu editatu nahi duzun galdera</h2><br />
			<input class="botoia" type="button" value="Home" onclick="location.href='./Layout.html';" />
			<div id="taula"></div>
		</center>
	</body>
</html>
<?php
	session_start();
	if(isset($_SESSION[User]) && $_SESSION[Irakasle] == "BAI"){
		$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
		
		$sen ="SELECT * FROM galdera ORDER BY `Zenbakia` DESC";	
		$ema=$esteka->query($sen);
		
		echo "<script>document.getElementById('taula').innerHTML= '";
		echo "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"70%\"><tr style=\"color:white;background-color:grey\">";
		echo "<th>Zenbakia</th><th>Egilea</th><th>Gaia</th><th>Galdera</th><th>Erantzuna</th><th>Zailtasuna</th></tr>";

		for($z = $ema->num_rows-1; $z>=0; $z--){
			$ema->data_seek($z);
			$l= $ema->fetch_assoc();
			$Zenbakia=$l['Zenbakia'];
			$Egilea=$l['Egilea'];
			$Gaia=$l['Gaia'];
			$Galdera=$l['Galdera'];
			$Erantzuna=$l['Erantzuna'];
			$Zailtasuna=$l['Zailtasuna'];
			echo "<tr class=\"lerroa\" onclick=\"aldatu($Zenbakia)\"><td>$Zenbakia</td><td>$Egilea</td><td>$Gaia</td><td>$Galdera</td><td>$Erantzuna</td><td>$Zailtasuna</td></tr>";	
		}
		echo "</table>';</script>";
		$esteka->close();	
	}else{
		echo "<script>document.getElementById('rqBody').innerHTML = '<center><h2 style=\"color: red\"> Irakasle moduan logeatu behar zara</h2></center>';</script>";
	}
	
?>