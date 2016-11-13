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
	</head>
	<body id="eqBody">
		<center>
			<br /><h2>Edita ezazu galdera</h2><br />
			<input class="botoia" type="button" value="Atzerantz" onclick="location.href='./reviewingQuizzes.php';" />
			<input class="botoia" type="button" value="Home" onclick="location.href='./Layout.html';" />
			<form name="gAldatu" method="POST" action="makeChanges.php">
			Gaia: <input id="gaia" type="text" name="Gaia"><br /><br />
				Galdera:<br />
				<textarea id="galdera" name="Galdera" cols="30" rows="4"></textarea><br /><br />
				
				Erantzuna:<br />
				<textarea id="erantzuna" name="Erantzuna" cols="30" rows="4"></textarea><br /><br />

				<fieldset style="display: inline-block;">
					<legend align="center">Zailtasuna</legend>
					<br/>
					1<input id="1" type="radio" name="Zailtasuna" value="1">
					2<input id="2" type="radio" name="Zailtasuna" value="2">
					3<input id="3" type="radio" name="Zailtasuna" value="3">
					4<input id="4" type="radio" name="Zailtasuna" value="4">
					5<input id="5" type="radio" name="Zailtasuna" value="5">
					Zehaztugabea<input id="zehaztugabe" type="radio" name="Zailtasuna" value="0">
				</fieldset>

				<br /><br />
				<input class="botoia" type="reset" value="Ezabatu" />
				<input class="botoia" type="submit" value="Gorde aldaketak" />
				<br />
			</form>
		</center>
	</body>
</html>
<?php
	session_start();
	if(isset($_SESSION[User]) && $_SESSION[Irakasle] == "BAI"){
		$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
		
		$sen ="SELECT * FROM `galdera` WHERE `Zenbakia` =$_COOKIE[gZb]";	
		$ema=$esteka->query($sen);

		$z = $ema->num_rows-1;
		$ema->data_seek($z);
		$l= $ema->fetch_assoc();
		$Gaia=$l['Gaia'];
		$Galdera=$l['Galdera'];
		$Erantzuna=$l['Erantzuna'];
		$Zailtasuna=$l['Zailtasuna'];
		
		echo "<script>document.getElementById('gaia').value = '$Gaia';</script>";
		echo "<script>document.getElementById('galdera').value = '$Galdera';</script>";
		echo "<script>document.getElementById('erantzuna').value = '$Erantzuna';</script>";
		if($Zailtasuna == 1){
			echo "<script>document.getElementById('1').checked = true;</script>";
		}
		else if($Zailtasuna == 2){
			echo "<script>document.getElementById('2').checked = true;</script>";
		}
		else if($Zailtasuna == 3){
			echo "<script>document.getElementById('3').checked = true;</script>";
		}
		else if($Zailtasuna == 4){
			echo "<script>document.getElementById('4').checked = true;</script>";
		}
		else if($Zailtasuna == 5){
			echo "<script>document.getElementById('5').checked = true;</script>";
		}
		else{
			echo "<script>document.getElementById('zehaztugabe').checked = true;</script>";
		}
		
		$esteka->close();
	}else{
		echo "<script>document.getElementById('eqBody').innerHTML = '<center><h2 style=\"color: red\"> Irakasle moduan logeatu behar zara</h2></center>';</script>";
	}

?>