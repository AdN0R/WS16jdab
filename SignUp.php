<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Quizzes</title>
		<link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='stylesPWS/wide.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='stylesPWS/smartphone.css' />
		
		<script src="JS.js"></script>
		</head>
	<body>
		<center>
		<h1 id="titulua"> Formularioa</h1><br />
		<form id="erregistro" name="erregistro" onSubmit="return balioztatu()" method="POST" action="Enroll.php">
			Izena: (*)<br />
			<input type="text" name="Izena"><br /><br />
			
			Abizena1: (*)<br />
			<input type="text" name="Abizena1"><br /><br />
			
			Abizena2: (*)<br />
			<input type="text" name="Abizena2"><br /><br />
			
			Eposta elektronikoa: (*)<br />
			<input type="text" name="Eposta" id="Eposta" value="<?php echo $_POST['Eposta']?>" readonly><br /><br />
			
			Pasahitza: (*)<br />
			<input type="password" name="Pasahitza" id="Pasahitza" value="<?php echo $_POST['Pasahitza']?>" readonly><br /><br />
			
			Telefono zenbakia: (*)<br />
			<input type="text" name="Telefonoa"><br /><br />
			
			Espezialitatea:<br />
			<select name="Espezialitatea">
				<option value="Software Ingeniaritza">Software Ingeniaritza</option>
				<option value="Konputagailuen Ingeniaritza">Konputagailuen Ingeniaritza</option>
				<option value="Konputazioa">Konputazioa</option>
				<option value="Besterik">Besterik</option>
			</select><br /><br />
			
			Intereseko teknologiak:<br />
			<textarea name="Teknologiak"></textarea><br /><br />
			
			Intereseko erremintak:<br />
			<textarea name="Erremintak"> </textarea><br /><br />
			
			<input class="botoia" type="button" value="Atzerantz" onclick="location.href='./SimpleReg.html';" />
			<input class="botoia" type="reset" value="Ezabatu" />
			<input class="botoia" type="submit" value="Bidali" />
		</form>
		</center>
	</body>
</html>