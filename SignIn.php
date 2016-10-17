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
	<body>
		<center>
			<h1 id="titulua">Autentikatu</h1><br />
			<form id="fAutentikatu" name="fAutentikatu" method="POST" action="SignIn.php">
			Eposta elektronikoa:<br />
			<input type="text" name="Eposta" value="LDAP@ikasle.ehu.es"><br /><br />
			
			Pasahitza:<br />
			<input type="password" name="Pasahitza"><br /><br />
			<input type="button" value="Atzerantz" onclick="location.href='./layout.html';">
			<input type="submit" value="Bidali">
			</form>
		</center>
	</body>
</html>
<?php
	if(isset($_POST['Eposta'])){
		if (!filter_var($_POST['Eposta'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-z]{3,}[0-9]{3}(@ikasle\.ehu\.e)(s|us)$/"))) === false) {
				$esteka = new mysqli("mysql.hostinger.es", "u361099527_u3610", "reportx9", "u361099527_quizz");
	
				$sen ="SELECT count(*) FROM erabiltzailea WHERE Eposta LIKE '$_POST[Eposta]' AND Pasahitza LIKE '$_POST[Pasahitza]'";	
				$ema=$esteka->query($sen);
				
				if($ema==1){
					setcookie("User", $_POST['Eposta'], 1800, "./");
					header("Location: ./InsertQuestion.php");
				}else{
					echo "<center><font color='red'>Email hau ez dago erregistratua</font></center>";
				}
		}else{
			echo "<center><font color='red'>Emailaren formatoa txarto dago</font></center>";
		}
	}

?>