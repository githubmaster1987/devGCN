<?php
session_start(); // On relaye la session
Require("Auth.inc.php");


/*
# echo $_SERVER['DOCUMENT_ROOT'];

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

$sql = "SHOW TABLES FROM $BDD";
$result = mysql_query($sql);

if (!$result) {
   echo "Erreur DB, impossible de lister les tables\n";
   echo 'Erreur MySQL : ' . mysql_error();
   exit;
}

while ($row = mysql_fetch_row($result)) {
	$tables[] = $row[0];
   #echo "Table : {$row[0]}\n<br />";
}

$tables = implode($tables,' ');

$requete = 'mysqldump --user='.$name.' --password='.$mdp.' --host='.$local.' '.$BDD.' '.$tables.' > '.dirname(__FILE__).'/test-export.sql';

exec($requete);

#echo file_exists(dirname(__FILE__).'/test-export.sql');

#echo $requete;

mysql_free_result($result);*/