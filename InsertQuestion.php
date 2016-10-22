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
			Materia: <input type="text" name="Materia"><br /><br />
			Galdera:<br />
			<textarea name="Galdera" cols="30" rows="5"></textarea><br /><br /><br />
			
			Erantzuna:<br />
			<textarea name="Erantzuna" cols="30" rows="5"> </textarea><br /><br /><br />

			<fieldset style="display: inline-block;">
			<legend align="center">Zailtasuna</legend>
			<br/>
			1<input type="radio" name="Zailtasuna" value="1">
			2<input type="radio" name="Zailtasuna" value="2">
			3<input type="radio" name="Zailtasuna" value="3">
			4<input type="radio" name="Zailtasuna" value="4">
			5<input type="radio" name="Zailtasuna" value="5">
			Zehaztugabea<input type="radio" name="Zailtasuna" value="0" checked>
			</fieldset>

			<br /><br /><br />
			<input class="botoia" type="button" value="Home" onclick="location.href='./Layout.html';" />
			<input class="botoia" type="reset" value="Ezabatu" />
			<input class="botoia" type="submit" value="Bidali" />
		</form>
		</center>
	</body>
</html>
<?php
	if(isset($_POST['Erantzuna'])){
		$esteka = new mysqli("mysql.hostinger.es", "u361099527_u3610", "reportx9", "u361099527_quizz");
		$sen ="INSERT INTO galdera(Egilea,Materia,Galdera,Erantzuna,Zailtasuna) VALUES('$_COOKIE[User]', '$_POST[Materia]', '$_POST[Galdera]', '$_POST[Erantzuna]', '$_POST[Zailtasuna]')";
		if(!$esteka->query($sen)){
			die('Errorea: ' . $esteka->error);		
		}		
		$esteka->close();
		
		//Gorde Galdera XML-n
		$xml = simplexml_load_file('galderak.xml','SimpleXMLElement', LIBXML_NOWARNING);
		if (!$xml){
			echo '<script>alert("Errorea XML txertaketan")</script>';
			exit;
		}
		$item = $xml->addChild('assessmentItem');
		$item->addAttribute('complexity', $_POST['Zailtasuna']);
		$item->addAttribute('subject', $_POST['Materia']);
		
		$body = $item->addChild('itemBody');
		$body->addChild('p', $_POST['Galdera']);
		
		$response = $item->addChild('correctResponse');
		$response->addChild('value', $_POST['Erantzuna']);

		$xml->asXML('galderak.xml');
		
		echo "Galdera gehitu da!";
		echo "<p> <a href='ShowQuestions.php'> Galderak ikusi</a></p><br />";
		echo "<p> <a href='seeXMLQuestions.php'> Galderak XML-n ikusi </a></p>";
	}
?>