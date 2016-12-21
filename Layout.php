<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - Home</title>
		<link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/est.css" rel="stylesheet">
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
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
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "EZ"){echo "<li><a href='./handlingQuizes.php'>Handle</a></li>";}?>
						<?php if(isset($_SESSION[User])){echo "<li><a href='./LogOut.php'>LogOut</a></li>";}?>
						<li><a href="./Credits.php">Credits</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container">
			<h2>
				Ongi etorri My Quiz webgunera !</h2><br/><br/><br/>
			<p class="text-muted">
				Webgune hau galderen biltegi bat da.<br/><br/>Anonimo moduan galderak ikus ditzakezu.<br/>Erabiltzaile kontua sortuz, galderak sor ditzakezu.<br/><br/><br/>Goza ezazu esperientziaz !<br/><br/><br/><br/><br/>
				<strong>My Quiz</strong>&nbsp;&nbsp;->&nbsp;&nbsp;Hasiera (orrialde hau)<br/>
				<strong>Quizzes</strong>&nbsp;&nbsp;->&nbsp;&nbsp;Galderak ikusi<br/>
				<strong>Credits</strong>&nbsp;&nbsp;->&nbsp;&nbsp;Garatzaileen informazioa ezagutu<br/><br/>
				<strong>Sign In</strong>&nbsp;&nbsp;->&nbsp;&nbsp;Erabiltzaile kontura sartu<br/>
				<strong>Sign Up</strong>&nbsp;&nbsp;->&nbsp;&nbsp;Erabiltzaile kontu berria sortu<br/><br/>
				<strong>Review</strong>&nbsp;&nbsp;->&nbsp;&nbsp;(administratzaile kautotua) Galdera guztiak editatu<br/>
				<strong>Handle</strong>&nbsp;&nbsp;->&nbsp;&nbsp;(kautotuta) Galderak gehitu<br/><br/>
				<strong>Log Out</strong>&nbsp;&nbsp;->&nbsp;&nbsp;(kautotuta) Sesioa itxi<br/><br/><br/><br/>
			</p>
		</div>
		
		<footer class="footer">
			<div class="container">
				<p class="text-muted"><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a>&nbsp;
				<a href='https://github.com/AdN0R/WS16jdab' target="_blank">Link GITHUB</a></p>
			</div>
		</footer>
	</body>
</html>