<?php
	Require("connexionBDD.php");
	function date_fr($date) { return substr($date,8,2).'/'.substr($date,5,2).'/'.substr($date,0,4); }
	$request = "SELECT * FROM paiements WHERE id = ".$_GET['id'];
	$data = mysql_query($request);
	$datas = mysql_fetch_array($data);
	
	$jsonData = array
	(
		'patient' => utf8_encode(stripslashes($datas['nom'])),
		'date' => date_fr($datas['date']),
		'type' => $datas['type'],
		'moyendepaiement' => $datas['moyendepaiement'],
		'montant' => $datas['montant']
	);
	
	echo json_encode($jsonData);	
?>