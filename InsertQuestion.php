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
		<h1 id="titulua">Galdera gehitu</h1><br />
		<form id="gGehitu" name="gGehitu" method="POST" action="InsertQuestion.php">
			Galdera:<br /><br />
			<textarea name="Galdera" cols="40" rows="6"> </textarea><br /><br /><br />
			
			Erantzuna:<br /><br />
			<textarea name="Erantzuna" cols="40" rows="6"> </textarea><br /><br /><br />

			Zailtasuna:<br /><br />
			<input type="radio" name="Zailtasuna" value="1" >1<br />
			<input type="radio" name="Zailtasuna" value="2" >2<br />
			<input type="radio" name="Zailtasuna" value="3" >3<br />
			<input type="radio" name="Zailtasuna" value="4" >4<br />
			<input type="radio" name="Zailtasuna" value="5" >5<br />
			<input type="radio" name="Zailtasuna" value="0" checked>Zehaztugabea<br /><br /><br />

			<input class="botoia" type="button" value="Home" onclick="location.href='./layout.html';" />
			<input class="botoia" type="reset" value="Ezabatu" />
			<input class="botoia" type="submit" value="Bidali" />
		</form>
		</center>
	</body>
</html>
<?php
	if(isset($_POST['Erantzuna'])){
		$esteka = new mysqli("mysql.hostinger.es", "u361099527_u3610", "reportx9", "u361099527_quizz");
		$sen ="INSERT INTO galdera(Egilea,Galdera,Erantzuna,Zailtasuna) VALUES('$_COOKIE[User]', '$_POST[Galdera]', '$_POST[Erantzuna]', '$_POST[Zailtasuna]')";
		if(!$esteka->query($sen)){
			die('Errorea: ' . $esteka->error);		
		}

		echo "Galdera gehitu da!";
		echo "<p> <a href='ShowQuestions.php'> Galderak ikusi</a>";
		
		$esteka->close();
	}
?>