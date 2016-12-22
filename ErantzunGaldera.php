<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - Erantzun</title>
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
			<div class="jumbotron"><h2>Galdera erantzun</h2></div>
		</div>
		<div class="container">
			<center>
				<div id="dMsg"></div>
				<form name="gErantzun" method="POST" action="ErantzunGaldera.php">
					<div class="row">
						<div class="form-group col-sm-offset-4 col-sm-4">
							<label for="Gaia">Gaia:</label>
							<input type="text" class="form-control" id="Gaia" name="Gaia" value="" readonly>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-offset-4 col-sm-4">
							<label for="Galdera">Galdera:</label>
							<textarea class="form-control" rows="4" id="Galdera" name="Galdera" value="" readonly></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-offset-4 col-sm-4">
							<label for="Zailtasuna">Zailtasuna:</label>
							<input type="text" class="form-control" id="Zailtasuna" name="Zailtasuna" value="" readonly>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-offset-4 col-sm-4">
							<label for="Erantzuna">Erantzuna:</label>
							<textarea class="form-control" rows="4" id="Erantzuna" name="Erantzuna" placeholder="Sartu galderaren erantzuna"></textarea>
						</div>
					</div>					

					<br /><br />
					<button type="submit" class="btn btn-default">Erantzun</button>
					<br />
				</form>
			</center>
		</div>
	</body>
</html>

<?php
	if(isset($_SESSION['nick'])){
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
			session_unset();
			session_destroy();
			header("Location: ./Nick.php");
		}
		$_SESSION['LAST_ACTIVITY'] = time();
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
		$esteka->close();
		
		echo "<script>document.getElementById('Gaia').value = '$Gaia';</script>";
		echo "<script>document.getElementById('Galdera').value = '$Galdera';</script>";
		echo "<script>document.getElementById('Zailtasuna').value = '$Zailtasuna';</script>";
		
		if(isset($_POST['Erantzuna'])){
			$_SESSION['saiak'] = $_SESSION['saiak'] + 1;
			if($_POST['Erantzuna'] == $Erantzuna){
				$_SESSION['asm'] = $_SESSION['asm'] + 1;
				echo "<script>document.getElementById('dMsg').className='alert alert-success alert-dismissible col-sm-offset-4 col-sm-4';document.getElementById('dMsg').innerHTML='<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a><strong>Ondo!</strong> Galdera ondo erantzun duzu.';</script>";
			}else{
				echo "<script>document.getElementById('dMsg').className='alert alert-danger alert-dismissible col-sm-offset-4 col-sm-4';document.getElementById('dMsg').innerHTML='<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a><strong>Txarto!</strong> Galdera txarto erantzun duzu.';</script>";
			}
		}
	}else{
		header("Location: ./Nick.php");
	}
?>