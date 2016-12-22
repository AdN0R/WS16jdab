<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - Edit</title>
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
			<div class="jumbotron"><h2>Galdera editatu</h2></div>
		</div>
		
		<div id="eqBody">
			<center>
				<form name="gAldatu" method="POST" action="makeChanges.php">
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
							<label class="radio-inline"><input type="radio" name="Zailtasuna" id="1" value="1">1</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" id="2" value="2">2</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" id="3" value="3">3</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" id="4" value="4">4</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" id="5" value="5">5</label>
							<label class="radio-inline"><input type="radio" name="Zailtasuna" id="zehaztugabe" value="0" checked>Zehaztugabea</label>
						</div>
					</div>

					<br /><br />
					<button type="reset" class="btn btn-default">Ezabatu</button>
					<button type="submit" class="btn btn-default">Gorde Aldaketak</button>
					<br />
				</form>
			</center>
		</div>
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
		
		echo "<script>document.getElementById('Gaia').value = '$Gaia';</script>";
		echo "<script>document.getElementById('Galdera').value = '$Galdera';</script>";
		echo "<script>document.getElementById('Erantzuna').value = '$Erantzuna';</script>";
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