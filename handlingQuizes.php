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
		</script>
	</head>
	<body id="hqBody">
		<div>
			<center>
			<h1 id="titulua">HQ: Galdera gehitu</h1><br />
			<form id="gGehitu" name="gGehitu" method="POST" action="handlingQuizes.php">
				Gaia: <input type="text" name="Gaia"><br /><br />
				Galdera:<br />
				<textarea name="Galdera" cols="30" rows="4"></textarea><br /><br />
				
				Erantzuna:<br />
				<textarea name="Erantzuna" cols="30" rows="4"> </textarea><br /><br />

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

				<br /><br />
				<input class="botoia" type="button" value="Home" onclick="location.href='./Layout.html';" />
				<input class="botoia" type="reset" value="Ezabatu" />
				<input class="botoia" type="submit" value="Bidali" />
				<br />
				<input class="botoia" type="button" value="Ikusi zure galderak" onclick="galIku()" />
			</form>
			</center>
		</div>
		<div id="txertatu"></div>
		<div id="galdiv" ></div>
	</body>
</html>
<?php
	session_start();
	if(isset($_SESSION[User]) && $_SESSION[Irakasle] == "EZ"){
		if(isset($_POST[Erantzuna])){
			echo '<script>document.getElementById("galdiv").innerHTML= "";</script>';
			$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
			$sen ="INSERT INTO galdera(Egilea,Gaia,Galdera,Erantzuna,Zailtasuna) VALUES('$_SESSION[User]', '$_POST[Gaia]', '$_POST[Galdera]', '$_POST[Erantzuna]', '$_POST[Zailtasuna]')";
			if(!$esteka->query($sen)){
				die('Errorea: ' . $esteka->error);		
			}		
			$esteka->close();
			
			//Gorde Galdera XML-n
			$xml = simplexml_load_file('galderak.xml','SimpleXMLElement', LIBXML_NOWARNING);
			if (!$xml){
				echo '<script>document.getElementById("txertatu").innerHTML= "Errorea XML txertaketan";</script>';
				exit;
			}
			$item = $xml->addChild('assessmentItem');
			$item->addAttribute('complexity', $_POST['Zailtasuna']);
			$item->addAttribute('subject', $_POST['Gaia']);
			
			$body = $item->addChild('itemBody');
			$body->addChild('p', $_POST['Galdera']);
			
			$response = $item->addChild('correctResponse');
			$response->addChild('value', $_POST['Erantzuna']);

			$xml->asXML('galderak.xml');
			
			echo "<script>document.getElementById('txertatu').innerHTML= \"Galdera gehitu da!\";</script>";
		}
	}else{
		echo "<script>document.getElementById('hqBody').innerHTML = '<center><h2 style=\"color: red\">Ikasle moduan Logeatu behar zara</h2></center>';</script>";
	}
?>