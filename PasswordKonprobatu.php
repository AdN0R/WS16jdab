<?php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	$soapclient = new nusoap_client('http://wsjdab.esy.es/egiaztatuPasahitza.php?wsdl', true);
	
	if (isset($_POST['Pass'])){
		echo $soapclient->call('passKonprobatu', array('x'=>$_POST['Pass']));
	}
?>