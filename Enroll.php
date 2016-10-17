<?php
	$val=$_POST['Eposta'];
	$opt=array("options"=>array("regexp"=>"/^[a-z]{3,}[0-9]{3}(@ikasle\.ehu\.e)(s|us)$/"));
	if(filter_var($val, FILTER_VALIDATE_REGEXP, $opt)){
		$esteka = new mysqli("mysql.hostinger.es", "u361099527_u3610", "reportx9", "u361099527_quizz");
			
		$sql = "INSERT INTO erabiltzailea VALUES('$_POST[Izena]', '$_POST[Abizena1]', '$_POST[Abizena2]', '$_POST[Eposta]', '$_POST[Pasahitza]', '$_POST[Telefonoa]', '$_POST[Espezialitatea]', '$_POST[Teknologiak]', '$_POST[Erremintak]')";	
		if(!$esteka->query($sql)){
			die('Errorea: ' . $esteka->error);		
		}
		
		echo "Erregistro bat gehitu da!";
		echo "<p> <a href='IkusiErabiltzaileak.php'> Erregistroak ikusi</a>";

		$esteka->close();
	}else{
		echo "Eposta ez du LDAP@ikasle.ehu.e(u)s formatua.";
		echo "<a href='SignUp.html'> Atzerantz</a>";
	}
?>