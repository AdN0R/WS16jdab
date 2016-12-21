<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - Handle</title>
		<link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/est.css" rel="stylesheet">
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		
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
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Nabigazio menua</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="./Layout.php">My Quiz</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="./ShowQuizz.php">Quizzes</a></li>
						<?php session_start(); if(!isset($_SESSION[User])){echo "<li><a href='./SignIn.php'>Sign In</a></li>";}?>
						<?php if(!isset($_SESSION[User])){echo "<li><a href='./SimpleReg.php'>Sign Up</a></li>";}?>
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "BAI"){echo "<li><a href='./reviewingQuizzes.php'>Review</a></li>";}?>
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "EZ"){echo "<li class='active'><a href='./handlingQuizes.php'>Handle</a></li>";}?>
						<?php if(isset($_SESSION[User])){echo "<li><a href='./LogOut.php'>LogOut</a></li>";}?>
						<li><a href="./Credits.php">Credits</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container">
			<div class="jumbotron"><h2>Erabiltzaile kontuaren galderen kudeaketa</h2></div>
		</div>
		<div id="hqBody">
			<div>
				<center>
				<form id="gGehitu" name="gGehitu" method="POST" action="handlingQuizes.php">
					<div class="row">
						<div class="form-group col-sm-offset-4 col-sm-4">
							<label for="Gaia">Gaia:</label>
							<input type="text" class="form-control" id="Gaia" name="Gaia" placeholder="Sartu gaia">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-offset-4 col-sm-4">
							<label for="Galdera">Galdera:</label>
							<textarea class="form-control" rows="4" id="Galdera" name="Galdera" placeholder="Sartu zure galdera"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-offset-4 col-sm-4">
							<label for="Erantzuna">Erantzuna:</label>
							<textarea class="form-control" rows="4" id="Erantzuna" name="Erantzuna" placeholder="Sartu galderaren erantzuna"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="radio">
							<label for="Zailtasuna"><strong>Zailtasuna:</strong></label><br />
							<label class="radio-inline"><input type="radio" name="Zailtasuna" value="1">1</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" value="2">2</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" value="3">3</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" value="4">4</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" value="5">5</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" value="0" checked>Zehaztugabea</label>
						</div>
					</div>

					<br /><br />
					<button type="reset" class="btn btn-default">Ezabatu</button>
					<button type="submit" class="btn btn-default">Bidali</button>
					<br />
					<button type="button" class="btn btn-default" onclick="galIku()">Ikusi zure galderak</button>
				</form>
				</center>
			</div>
			<div id="txertatu"></div>
			<div id="galdiv" ></div>
		</div>
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