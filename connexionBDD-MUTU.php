<?php
// Empacement 
$local='mysql5-8';
// Nom de l'utilisateur
$name='drbellitybdd';
// Mot de Pass
$mdp='OMlktMwr';
// Nom de la BDD;
$BDD='drbellitybdd';

// connexion
$db = mysql_connect($local,$name,$mdp);
mysql_select_db($BDD, $db);

?>
