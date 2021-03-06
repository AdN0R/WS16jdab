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
						<?php if(isset($_SESSION[User]) && $_SESSION["Irakasle"] == "EZ"){echo "<li class='active'><a href='./handlingQuizes.php'>Sortu Galdera</a></li>";}?>
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
			<div class="jumbotron"><h2>Erabiltzaile kontuaren galderen kudeaketa</h2></div>
		</div>
		<div id=zenb></div>
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
			
			echo "<script>document.getElementById('txertatu').innerHTML= \"Galdera gehitu da!\";</script>";
		}
	}else{
		echo "<script>alert(\"Ikasle moduan Logeatu behar zara\"); window.location = \"./Layout.php\";</script>";
	}
	if(isset($_SESSION[User])){
		$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
		$sen ="SELECT COUNT(*) FROM galdera WHERE egilea = '$_SESSION[User]'";
		$ema=$esteka->query($sen);
		if(!$ema){
			die('Errorea: ' . $esteka->error);		
		}
		$z = $ema->num_rows-1;
		$ema->data_seek($z);
		$l= $ema->fetch_assoc();
		$EraG=$l['COUNT(*)'];
		
		$sen ="SELECT COUNT(*) FROM galdera";
		$ema=$esteka->query($sen);
		if(!$ema){
			die('Errorea: ' . $esteka->error);		
		}
		$z = $ema->num_rows-1;
		$ema->data_seek($z);
		$l= $ema->fetch_assoc();
		$GuzG=$l['COUNT(*)'];
		
		$esteka->close();
		
		echo"<script>document.getElementById('zenb').innerHTML= '<center><h4>Zure erabiltzaile kontuaren galdera kopurua: $EraG</h4><h4>Webguneko galdera kopurua: $GuzG</h4><br/><br/></center>';</script>";
	}
?>