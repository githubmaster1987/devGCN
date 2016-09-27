<?php Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");
if(isset($_POST['modifNote']))
	{
		$notes=utf8_decode($_POST['note']);
		$sqlNotes="UPDATE `Patients` SET `Notes` = '$notes' WHERE `Id` = '".$_POST['PatientID']."' ;";
		$sqlNoteExe=mysql_query($sqlNotes);
	}

?>
