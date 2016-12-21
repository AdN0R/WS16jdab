<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - Sign In</title>
		
		<link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/est.css" rel="stylesheet">
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		
		<script src="JS.js"></script>
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
						<?php session_start(); if(!isset($_SESSION[User])){echo "<li class='active'><a href='./SignIn.php'>Sign In</a></li>";}?>
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
			<div class="jumbotron"><h2>Logeatu erabiltzaile kontura</h2></div>
		</div>
		
		<form id="fAutentikatu" name="fAutentikatu" method="POST" action="SignIn.php">
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Eposta">Eposta ekektronikoa:</label>
					<input type="email" class="form-control" id="Eposta" name="Eposta" placeholder="LDAP@ikasle.ehu.e(u)s">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Pasahitza">Pasahitza:</label>
					<input type="password" class="form-control" id="Pasahitza" name="Pasahitza" placeholder="Sartu pasahitza">
				</div>
			</div>
			<button type="submit" class="btn btn-default col-sm-offset-5">Bidali</button>
		</form>
	</body>
</html>
<?php
	if(isset($_POST[Eposta])){
		if(!isset($_SESSION["SaiPos"]) || $_SESSION["SaiPos"] != $_POST[Eposta]){
			$_SESSION["SaiPos"] = $_POST[Eposta];
			$_SESSION["SaiKop"] = 0;
		}
		if($_SESSION["SaiPos"] == $_POST[Eposta] && $_SESSION["SaiKop"] == 3){
			echo "<center><font color='red'>Saiakera kopuru maximora heldu zara </font></center>";
		}
		else if (!filter_var($_POST[Eposta], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-z]{3,}[0-9]{3}(@ikasle\.ehu\.e)(s|us)$/"))) === false) {
				$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
	
				$sen ="SELECT Pasahitza FROM erabiltzailea WHERE Eposta LIKE '$_POST[Eposta]'";
				$ema=$esteka->query($sen);
				$z = $ema->num_rows;
				if($z==1){
					$ema->data_seek(1);
					$l= $ema->fetch_assoc();
					$Pasahitza=$l['Pasahitza'];
					$p = $_POST["Pasahitza"];
					if($Pasahitza == sha1($p)){
						session_start();
						$_SESSION["User"] = $_POST[Eposta];
						$_SESSION["Irakasle"] = "EZ";
						header("Location: ./handlingQuizes.php");
					}
					else{
						echo "<center><font color='red'>Errorea: Pasahitza ez da zuzena</font></center>";
						$_SESSION["SaiKop"] = $_SESSION["SaiKop"] + 1;
						echo "<center><font color='red'>Saiakera kopurua: $_SESSION[SaiKop]</font></center>";
					}
				}
				else{
					echo "<center><font color='red'>Errorea: Emaila ez da zuzena</font></center>";
				}
		}else if(!filter_var($_POST[Eposta], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-z]{3,}[0-9]{3}(@ehu\.e)(s|us)$/"))) === false){
			$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
	
			$sen ="SELECT Pasahitza FROM erabiltzailea WHERE Eposta LIKE '$_POST[Eposta]'";
			$ema=$esteka->query($sen);
			$z = $ema->num_rows;
			if($z==1){
				$ema->data_seek(1);
				$l= $ema->fetch_assoc();
				$Pasahitza=$l['Pasahitza'];
				$p = $_POST["Pasahitza"];
				if($Pasahitza == sha1($p)){
					session_start();
					$_SESSION["User"] = $_POST[Eposta];
					$_SESSION["Irakasle"] = "BAI";
					header("Location: ./reviewingQuizzes.php");
				}
				else{
					echo "<center><font color='red'>Errorea: Pasahitza ez da zuzena</font></center>";
				}
			}
			else{
				echo "<center><font color='red'>Errorea: Emaila ez da zuzena</font></center>";
			}
		}else{
			echo "<center><font color='red'>Emailaren formatoa txarto dago</font></center>";
		}
	}

?>