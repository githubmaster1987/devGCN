<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


//requete permettant d'enregistrer les modifications Clinique
if(isset ($_POST['newClinique']))
{
	$Clinique = $_POST['nomClinique'];
	$addClinique = $_POST['addClinique'];
	$cpClinique = $_POST['cpClinique'];
	$villeClinique = $_POST['villeClinique'];
	$telClinique = $_POST['telClinique'];
	$faxClinique = $_POST['faxClinique'];
	$queryModifClinique = "UPDATE `Cliniques` SET `Clinique` = '$Clinique',`Adresse` = '$addClinique',`CP` = '$cpClinique',`Ville` = '$villeClinique' ,`Tel` = '$telClinique' ,`Fax` = '$faxClinique' WHERE `IdClinique` = '".$_POST['IdClinique']."';";
	$queryModifCliniqueResult = mysql_query($queryModifClinique);
	header("Location:administrationClinique.php");
}

//requete permettant de supprimer une Clinique
if(isset ($_POST['supprimerClinique']))
{
$querySupprimer = "DELETE FROM `Cliniques` WHERE `IdClinique` = '".$_POST['IdClinique']."';";
$querySupprimerResult = mysql_query($querySupprimer);
header("Location:administrationClinique.php");
}

//requete permettant de recuperer la clinique concernée
if(isset($_GET['IdClinique']))
{
	$queryClinique = "SELECT * FROM Cliniques WHERE `IdClinique`= '".$_GET['IdClinique']."';";
	$queryCliniqueResult = mysql_query($queryClinique);
	$sqldata = mysql_fetch_array($queryCliniqueResult);
}else
{
	header("Location:index.php");
}



include("header.html");	
?>
	<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
	
	<!--MENU-->
			<table cellpadding="2" cellspacing="2">
			<tr>
				<td colspan="3"><center>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationClinique.php" style="text-decoration:none;">Retour administration clinique</a></td>
							<td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
						</tr>
					</table>
	   	</center></td>
			</tr>
   
		</table>
	
<!--FICHE CLINIQUE-->
	<table width="600" cellpadding="3" cellspacing="3" border="0">
	<form method="post" >
		<tr>
			<td width="100"><strong>Nom Clinique : </strong></td><td><input name="nomClinique" type="text" size="30" value="<?php echo $sqldata['Clinique']; ?>"/><center></td>
		</tr>
		<tr>
			<td><strong>Adresse : </strong></td><td><input name="addClinique" type="text" size="30" value="<?php echo $sqldata['Adresse']; ?>"/><center></td>
		</tr>
		<tr>
			<td><strong>CP : </strong></td><td><input name="cpClinique" type="text"  size="30" value="<?php echo $sqldata['CP']; ?>"/><center></td>
		</tr>
		<tr>
			<td><strong>Ville : </strong></td><td><input name="villeClinique" type="text" size="30" value="<?php echo $sqldata['Ville']; ?>"/><center></td>
		</tr>
		<tr>
			<td><strong>Tel : </strong></td><td><input name="telClinique" type="text" size="30" value="<?php echo $sqldata['Tel']; ?>"/><center></td>
		</tr>
		<tr>
			<td><strong>Fax : </strong></td><td><input name="faxClinique" type="text" size="30" value="<?php echo $sqldata['Fax']; ?>"/><center></td>
		</tr>	
		
		<!--BOUTONS-->
		
			   <tr height="60">
	   	<td colspan="2"><center>
				<table cellpadding="0" cellspacing="0" border="0">			
					<tr>
						<td valign="top">
							<input type="hidden" name="IdClinique" value="<?php echo $sqldata['IdClinique'];?>"/>
							<input type="submit" value="Enregistrer Modifications" name="newClinique"/>&nbsp;&nbsp;
							</form>
						</td>
							
						<td>
							<form method="post" onSubmit="return confirm('Etes-vous s&ucirc;r de supprimer cette clinique ?')">
								<input type="hidden" name="IdClinique" value="<?php echo $sqldata['IdClinique'];?>"/>
								<input type="submit" value="Supprimer" name="supprimerClinique"/>&nbsp;&nbsp;
							</form>
						</td>

					</tr>
					
				</table>
			</center>
		</td>
	   </tr>
		
	</table>
	
	
	
	
	
	
	
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php
include("footer.html");
mysql_close();
?>