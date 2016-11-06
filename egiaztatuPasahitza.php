<?php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	$server = new soap_server;
	$ns="http://wsjdab.esy.es";
	$server->configureWSDL('passKonprobatu', $ns);
	$server->wsdl->schemaTargetNamespace=$ns;
	$server->register('passKonprobatu', array('x'=>'xsd:string'), array('return'=>'xsd:string'), $ns);

	function passKonprobatu($x){
		$fp = fopen("toppasswords.txt", "r");
		$aur = false;
		while(!feof($fp)){
			$ler = trim(fgets($fp));
			if( strcmp("$ler","$x") == 0){
				$aur = true;
				break;
			}
		}
		fclose($fp);
		if($aur){
			return "BALIOGABEA";
		}else{
			return "BALIOZKOA";
		}
	}

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
?>