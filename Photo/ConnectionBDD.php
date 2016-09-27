<?php
// Empacement 
$local='mysql5-6';
// Nom de l'utilisateur
$name='francoiszxbdd';
// Mot de Pass
$mdp='38CByZwn';
// Nom de la BDD;
$BDD='francoiszxbdd';

// connexion
$db = mysql_connect($local,$name,$mdp);
mysql_select_db($BDD, $db);

?>
