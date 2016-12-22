<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - Berrezarri</title>
		
		<link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/est.css" rel="stylesheet">
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		
		<script src="JS.js"></script>
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
						<li><a href="./ShowQuizz.php">Quizzes</a></li>
						<?php session_start(); if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "BAI"){echo "<li><a href='./reviewingQuizzes.php'>Galderak ikusi</a></li>";}?>
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "BAI"){echo "<li><a href='./Erabiltzaileak.php'>Erabiltzaileak ikusi</a></li>";}?>
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "EZ"){echo "<li><a href='./handlingQuizes.php'>Sortu Galdera</a></li>";}?>
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "EZ"){echo "<li><a href='./ErabiltzaileGalderak.php'>Ikusi Galderak</a></li>";}?>						
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
			<div class="jumbotron"><h2>Pasahitza Berrezarri</h2></div>
		</div>
		
		<div id="errorMsg"></div>
		<form id="fBerrezarri" name="fBerrezarri" method="POST" action="PasahitzaBerrezarri.php">
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Eposta">Eposta ekektronikoa:</label>
					<input type="email" class="form-control" id="Eposta" name="Eposta" placeholder="LDAP@ikasle.ehu.e(u)s">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Pasahitza">Pasahitza berria:</label>
					<input type="password" class="form-control" id="Pasahitza" name="Pasahitza" placeholder="Sartu pasahitza">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Pasahitza">Pasahitza berria errepikatu:</label>
					<input type="password" class="form-control" id="Pasahitza2" name="Pasahitza2" placeholder="Errepikatu pasahitza">
				</div>
			</div>
			<button type="submit" class="btn btn-default col-sm-offset-7">Bidali</button>
		</form>
	</body>
</html>
<?php
	if(isset($_POST[Eposta]) && isset($_POST[Pasahitza]) && isset($_POST[Pasahitza2])){
		if (!filter_var($_POST[Eposta], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-z]{3,}[0-9]{3}(@ikasle\.ehu\.e)(s|us)$/"))) === false) {
			if(strlen($_POST['Pasahitza'])>= 6){
				if($_POST['Pasahitza'] == $_POST['Pasahitza2']){
					$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
					$pass = sha1($_POST['Pasahitza']);
					
					$sql = "UPDATE erabiltzailea SET Pasahitza = '$pass' WHERE Eposta LIKE '$_POST[Eposta]'";	
					if(!$esteka->query($sql)){
						die("$Errorea: " . $esteka->error);		
					}

					$esteka->close();
					echo "<script>alert('Pasahitza aldatu da!');window.location = \"./SignIn.php\";</script>";
				}else{
					echo "<script>document.getElementById('errorMsg').className='alert alert-danger alert-dismissible col-sm-offset-4 col-sm-4';document.getElementById('errorMsg').innerHTML='<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a><strong>Errorea!</strong> Pasahitzak berdinak izan behar dira.';</script>";
				}
			}else{
				echo "<script>document.getElementById('errorMsg').className='alert alert-danger alert-dismissible col-sm-offset-4 col-sm-4';document.getElementById('errorMsg').innerHTML='<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a><strong>Errorea!</strong> Pasahitza 6 baino luzeagoa izan behar da.';</script>";
			}
		}else{
			echo "<script>document.getElementById('errorMsg').className='alert alert-danger alert-dismissible col-sm-offset-4 col-sm-4';document.getElementById('errorMsg').innerHTML='<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a><strong>Errorea!</strong> Eposta formatu desegokia dauka.';</script>";
		}
				
	}
?>