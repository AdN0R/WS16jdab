<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=false;">
		<title>Quiz - Sign Up</title>
		
		<link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/est.css" rel="stylesheet">
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		
		<script src="JS.js"></script>
		<script type="text/javascript" language="javascript">
			xhttp = new XMLHttpRequest();
			xhttp2 = new XMLHttpRequest();
			xhttp3 = new XMLHttpRequest();
			
			xhttp.onreadystatechange = function(){
				if((xhttp.readyState==4)&&(xhttp.status==200)){
					document.getElementById("dposta").innerHTML= xhttp.responseText;
				}
			};
			xhttp2.onreadystatechange = function(){
				if((xhttp2.readyState==4)&&(xhttp2.status==200)){
					document.getElementById("dpasahitza").innerHTML= xhttp2.responseText;
				}
			};
			xhttp3.onreadystatechange = function(){
				if((xhttp3.readyState==4)&&(xhttp3.status==200)){
					document.getElementById("dposta2").innerHTML= xhttp3.responseText;
				}
			};
			
			function epostaKonprobatu(){
				var posta = document.getElementById("Eposta").value;
				xhttp.open("GET","MatrikulaKonprobatu.php?Eposta="+posta, true);
				xhttp.send();
				
				xhttp3.open("GET","ErrepikatutaKonprobatu.php?Errepika="+posta, true);
				xhttp3.send();
			}
			
			function passKonprobatu(){
				var pass = document.getElementById("Pasahitza").value;
				if (pass.trim().length < 6){
					document.getElementById("dpasahitza").innerHTML= "<span style='color:red'>Pasahitzak 6ko luzera edo gehiago euki behar du</span>";
				}else{
					xhttp2.open("POST","PasswordKonprobatu.php", true);
					xhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xhttp2.send("Pass="+pass);
				}
			}
			
			function passBerdinak(){
				var p1 = document.getElementById("Pasahitza").value;
				var p2 = document.getElementById("Pasahitza2").value;
				if (p1.localeCompare(p2) != 0){
					document.getElementById("dpasahitza2").innerHTML= "<span style='color:red'>Pasahitzak berdinak izan behar dira</span>";
				}else{
					document.getElementById("dpasahitza2").innerHTML= "";
				}
			}
			
			function konp(){
				if((document.getElementById("dposta2").innerHTML.trim() === "BAI") && (document.getElementById("dpasahitza").innerHTML.trim() === "BALIOZKOA") && (document.getElementById("dposta").innerHTML.trim() === "BAI") && (document.getElementById("dpasahitza2").innerHTML.trim() === "")){
					return true;
				}else{
					return false;
				}
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
						<?php if(!isset($_SESSION[User])){echo "<li class='active'><a href='./SimpleReg.php'>Sign Up</a></li>";}?>
						<?php if(!isset($_SESSION[User])){echo "<li><a href='./SignIn.php'>Sign In</a></li>";}?>
						<?php if(isset($_SESSION[User])){echo "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>$_SESSION[User] <span class='caret'></span></a><ul class='dropdown-menu'><li><a href='./LogOut.php'>LogOut</a></li></ul></li>";}?>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container">
			<div class="jumbotron"><h2>Erabiltzaile kontu berria sortu</h2></div>
		</div>
		
		<form id="simreg" name="simreg" onSubmit="return konp()" method="POST" action="SignUp.php">
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Eposta">Eposta ekektronikoa:</label>
					<input type="email" class="form-control" id="Eposta" name="Eposta" onblur="epostaKonprobatu()" placeholder="LDAP@ikasle.ehu.e(u)s">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Pasahitza">Pasahitza:</label>
					<input type="password" class="form-control" id="Pasahitza" name="Pasahitza" onblur="passKonprobatu()" placeholder="Sartu pasahitza">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-offset-4 col-sm-4">
					<label for="Pasahitza2">Errepikatu pasahitza:</label>
					<input type="password" class="form-control" id="Pasahitza2" name="Pasahitza2" onblur="passBerdinak()" placeholder="Errepikatu pasahitza">
				</div>
			</div>
			<button type="submit" class="btn btn-default col-sm-offset-5">Bidali</button>
		</form>

		<br /><br />
		<div class="container col-sm-offset-4">
			Postaren balidazioa:&nbsp;
			<div id="dposta" style="display:inline"></div><br/><br/>
			Posta libre:&nbsp;
			<div id="dposta2" style="display:inline"></div><br/><br/>
			Pasahitzaren balidazioa:
			<div id="dpasahitza"></div>
			<div id="dpasahitza2"></div>
		</div>
	</body>
</html>