<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - Quizzes</title>
		<link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/est.css" rel="stylesheet">
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
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
						<?php if(!isset($_SESSION[User])){echo "<li><a href='./Nick.php'>Erantzun Galderak</a></li>";}?>
						<?php session_start(); if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "BAI"){echo "<li><a href='./reviewingQuizzes.php'>Galderak ikusi</a></li>";}?>
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "BAI"){echo "<li><a href='./Erabiltzaileak.php'>Erabiltzaileak ikusi</a></li>";}?>
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "EZ"){echo "<li><a href='./handlingQuizes.php'>Sortu Galdera</a></li>";}?>
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "EZ"){echo "<li clas='active'><a href='./ErabiltzaileGalderak.php'>Ikusi Galderak</a></li>";}?>						
						<li><a href="./Credits.php">Credits</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if(!isset($_SESSION[User])){echo "<li><a href='./SimpleReg.php'>Sign Up</a></li>";}?>
						<?php if(!isset($_SESSION[User])){echo "<li><a href='./SignIn.php'>Sign In</a></li>";}?>
						<?php if(isset($_SESSION[User])){echo "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>$_SESSION[User] <span class='caret'></span></a><ul class='dropdown-menu'><li><a href='./LogOut.php'>LogOut</a></li></ul></li>";}?>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container">
			<div class="jumbotron"><h2>Erabiltzaile kontuaren galderak bistaratu</h2></div>
		</div>
		<div>
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
					echo "<script>alert(\"Ikasle moduan Logeatu behar zara!\"); window.location = \"./Layout.php\";</script>";
				}
			?>
		</div>
	</body>
</html>