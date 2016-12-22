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
		<script type="text/javascript" language="javascript" >
			function erantzun(zbk){
				document.cookie = "gZb="+zbk;
				window.location.href="./ErantzunGaldera.php";
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
			<div class="jumbotron"><h2>Galderak bistaratu</h2></div>
		</div>
		<div class="container">
			<center>
				<div class="row col-md-offset-4 col-md-4">
					Asmatutakoak: <?php echo $_SESSION['asm']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Saiakerak: <?php echo $_SESSION['saiak']?><br>
					<div class="progress">
					<?php
						if ($_SESSION['saiak'] == 0){
							echo "<div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'>
								0%
							</div>";
						}else{
							$a = $_SESSION['asm'];
							$s = $_SESSION['saiak'];
							$t = ($a/$s)*100;
							$t = number_format((float)$t, 2, '.', '');
							echo "<div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow=\"$t\" aria-valuemin='0' aria-valuemax='100' style='width:$t%'>
								$t%
							</div>";
						}
					?>
					</div>
				</div>
			</center>
		</div>
		<?php
			$esteka = new mysqli("mysql.hostinger.es", "u396344456_1", "donosti16", "u396344456_quizz");
			
			$sen ="SELECT Zenbakia, Galdera, Zailtasuna FROM galdera ORDER BY `Zenbakia` DESC";	
			$ema=$esteka->query($sen);
			
			echo "<div id='container'><div class='col-md-offset-3 col-md-6 table-responsive'><table class='table-striped'>";
			echo "<thead><tr><th>Galdera</th><th>Zailtasuna</th></tr></thead><tbody>";
			for ($z = $ema->num_rows-1; $z>=0; $z--){
				$ema->data_seek($z);
				$l= $ema->fetch_assoc();
				$Zbk=$l['Zenbakia'];
				$Galdera=$l['Galdera'];
				$Zailtasuna=$l['Zailtasuna'];
				echo"<tr class=\"lerroa\" onclick=\"erantzun('$Zbk')\"><td>$Galdera</td><td>$Zailtasuna</td></tr>";
			}
			echo "</tbody></table></div></div>";
			$esteka->close();
		?>
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
	}else{
		header("Location: ./Nick.php");
	}
?>