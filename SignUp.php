<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - RegDat</title>
		
		<link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/est.css" rel="stylesheet">
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		
		<script src="JS.js"></script>
		<script>
			function erakutsiArg(fileInput) {
				var files = fileInput.files;
				for (var i = 0; i < files.length; i++) {           
					var file = files[i];
					var imageType = /image.*/;     
					if (!file.type.match(imageType)) {
						continue;
					}           
					var img=document.getElementById("ikusi");            
					img.file = file;    
					var reader = new FileReader();
					reader.onload = (function(aImg) { 
						return function(e) { 
							aImg.src = e.target.result; 
						}; 
					})(img);
					reader.readAsDataURL(file);
				}    
			}
			
			function ezabatuArg(){
				document.getElementById("ikusi").src = "";  
			}
		</script>
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
			<div class="jumbotron"><h2>Erabiltzaile kontua sortzeko datuak</h2></div>
		</div>
	
		<center>
		<form id="erregistro" name="erregistro" enctype="multipart/form-data" onSubmit="return balioztatu()" method="POST" action="SignUp.php">
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Izena">Izena:</label>
					<input type="text" class="form-control" id="Izena" name="Izena" placeholder="(*) Sartu zure izena">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Abizena1">Lehen Abizena:</label>
					<input type="text" class="form-control" id="Abizena1" name="Abizena1" placeholder="(*) Sartu zure lehen abizena">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Abizena2">Bigarren Abizena:</label>
					<input type="text" class="form-control" id="Abizena2" name="Abizena2" placeholder="(*) Sartu zure bigarren abizena">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Eposta">Eposta ekektronikoa:</label>
					<input type="email" class="form-control" id="Eposta" name="Eposta" value="<?php echo $_POST['Eposta']?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Pasahitza">Pasahitza:</label>
					<input type="password" class="form-control" id="Pasahitza" name="Pasahitza" value="<?php echo $_POST['Pasahitza']?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Telefonoa">Telefono zenbakia:</label>
					<input type="text" class="form-control" id="Telefonoa" name="Telefonoa" placeholder="(*) Sartu zure telefonoa">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Espezialitatea">Espezialitatea:</label>
					<select name="Espezialitatea" id="Espezialitatea" class="selectpicker">
						<option value="Software Ingeniaritza">Software Ingeniaritza</option>
						<option value="Konputagailuen Ingeniaritza">Konputagailuen Ingeniaritza</option>
						<option value="Konputazioa">Konputazioa</option>
						<option value="Besterik">Besterik</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Teknologiak">Intereseko teknologiak:</label>
					<textarea class="form-control" rows="4" id="Teknologiak" name="Teknologiak"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Erremintak">Intereseko erremintak:</label>
					<textarea class="form-control" rows="4" id="Erremintak" name="Erremintak"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label class="control-label">Argazkia igo:</label>
					<img id="ikusi" src="" style="width:20%; margin-top:10px;"/>
					<input type="file" id="Argazkia" name="Argazkia" accept="image/*" onchange="erakutsiArg(this)">
				</div>
			</div>
			
			<button type="reset" class="btn btn-default" onclick="ezabatuArg()">Ezabatu</button>
			<button type="submit" class="btn btn-default">Bidali</button>
		</form>
		</center>
	</body>
</html>

<?php
	if(isset($_POST[Eposta]) && isset($_POST[Izena])){
		if($_FILES['Argazkia']['tmp_name'] != '') {
            $arg = addslashes(file_get_contents($_FILES['Argazkia']['tmp_name']));			
        }
        else {
            $arg  = addslashes(file_get_contents("./img/user.jpg"));
        }
		
		$pass = sha1($_POST["Pasahitza"]);
		
		$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
			
		$sql = "INSERT INTO erabiltzailea VALUES('$_POST[Izena]', '$_POST[Abizena1]', '$_POST[Abizena2]', '$_POST[Eposta]', '$pass', '$_POST[Telefonoa]', '$_POST[Espezialitatea]', '$_POST[Teknologiak]', '$_POST[Erremintak]', '$arg')";	
		if(!$esteka->query($sql)){
			die("$Errorea: " . $esteka->error);		
		}

		$esteka->close();
		echo "<script>alert('Erregistro bat gehitu da!');  window.location = './SignIn.php';</script>";
	}
?>