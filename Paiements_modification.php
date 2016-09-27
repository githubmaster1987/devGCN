<?php
	Require("connexionBDD.php");
	function date_us($date) { return substr($date,6,4).'-'.substr($date,3,2).'-'.substr($date,0,2); }
	$request = "UPDATE paiements SET nom = '".utf8_decode(addslashes($_GET['patient']))."',
									 date = '".date_us($_GET['date'])."',
									 type = '".$_GET['type']."',
									 moyendepaiement = '".$_GET['moyendepaiement']."',
									 montant = '".$_GET['montant']."' WHERE id = ".$_GET['id'];
	mysql_query($request);
?>