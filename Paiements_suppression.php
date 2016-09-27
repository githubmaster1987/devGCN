<?php
	Require("connexionBDD.php");
	$request = "DELETE FROM paiements WHERE id = ".$_GET['id'];
	mysql_query($request);
?>