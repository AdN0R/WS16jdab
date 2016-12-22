<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - Credits</title>
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
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "EZ"){echo "<li><a href='./ErabiltzaileGalderak.php'>Ikusi Galderak</a></li>";}?>						
						<li class="active"><a href="./Credits.php">Credits</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if(!isset($_SESSION[User])){echo "<li><a href='./SimpleReg.php'>Sign Up</a></li>";}?>
						<?php if(!isset($_SESSION[User])){echo "<li><a href='./SignIn.php'>Sign In</a></li>";}?>
						<?php if(isset($_SESSION[User])){echo "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>$_SESSION[User] <span class='caret'></span></a><ul class='dropdown-menu'><li><a href='./LogOut.php'>LogOut</a></li></ul></li>";}?>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container margen">	
			<div class="row">
				<div class="col-md-3">
					<b>Izen-abizenak:</b> Andoni Bermo Pérez<br />
					<b>Espezialitatea:</b> Software Ingeniaritza<br />
					<b>Jaiotze-data:</b> 1993ko otsailaren 27a<br />
					<b>Jaioterria:</b> Bilbo <br />
					<b>Argazkia:</b> <img class="img-circle" width="304" height="236" src="https://dollarvigilante.com/sites/default/files/images/Lenin.jpg" /><br /><br />
				</div>
				<div class="col-md-offset-1 col-md-3">
					<b>Izen-abizenak:</b> Julen Diez Martin<br />
					<b>Espezialitatea:</b> Software Ingeniaritza<br />
					<b>Jaiotze-data:</b> 1993ko urtarilaren 26a<br />
					<b>Jaioterria:</b> Santurtzi <br />
					<b>Argazkia:</b> <img class="img-circle" width="304" height="236" src="https://stalinsmoustache.files.wordpress.com/2012/06/stalin-laughing-02.jpg"/><br /><br />			
				</div>
				<div class="col-md-offset-1 col-md-4">
					<b>Izen-abizenak:</b> Beñat Jimenez Urbieta<br />
					<b>Espezialitatea:</b> Konputagailuen Ingeniaritza<br />
					<b>Jaiotze-data:</b> 1994ko ekainaren 5a<br />
					<b>Jaioterria:</b> Zumaia<br />
					<b>Argazkia:</b> <img class="img-circle" width="304" height="236" src="https://ugc.kn3.net/i/origin/http://cdn.history.com/sites/2/2014/02/Trotsky.jpg" /><br /><br />			
				</div>
			</div>
		</div>

		<footer class="footer">
			<div class="container">
				<p class="text-muted"><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a>&nbsp;
				<a href='https://github.com/AdN0R/WS16jdab' target="_blank">Link GITHUB</a></p>
			</div>
		</footer>
	
	</body>
</html>