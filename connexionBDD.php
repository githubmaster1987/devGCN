<?php
// Empacement 
$local='192.95.29.223';
// Nom de l'utilisateur
$name='pbellity1';
// Mot de Pass
$mdp='abcd1234';
// Nom de la BDD;
$BDD='pbellity1';

// connexion
$db = mysql_connect($local,$name,$mdp);
mysql_select_db($BDD, $db);

?>
