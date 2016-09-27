<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

//requete permettant d'enregistrer les modifications Anesthesiste
if(isset ($_POST['newAnesthe']))
{
	$Anesthe = $_POST['nomAnesthe'];
	$queryModifAnesthe = "UPDATE `Anesthesistes` SET `Anesthesiste` = '$Anesthe' WHERE `IdAnesthe` = '".$_POST['IdAnesthe']."';";
	$queryModifAnestheResult = mysql_query($queryModifAnesthe);
	header("Location:administrationAnesthesiste.php");
}

//requete permettant de supprimer un Anesthesiste
if(isset ($_POST['supprimerAnesthe']))
{
$querySupprimer = "DELETE FROM `Anesthesistes` WHERE `IdAnesthe` = '".$_POST['IdAnesthe']."';";
$querySupprimerResult = mysql_query($querySupprimer);
header("Location:administrationAnesthesiste.php");
}

//requete permettant de recuperer l'anesthesiste concerne
if(isset($_GET['IdAnesthe']))
{
	$queryAnesthe = "SELECT * FROM Anesthesistes WHERE `IdAnesthe`= '".$_GET['IdAnesthe']."';";
	$queryAnestheResult = mysql_query($queryAnesthe);
	$sqldata = mysql_fetch_array($queryAnestheResult);
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
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationMasterCro.php" style="text-decoration:none;">Retour administration CRO</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationAnesthesiste.php" style="text-decoration:none;">Retour administration anesthesiste</a></td>
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
			<td colspan="4"><strong>Nom Anesth�siste : </strong><input name="nomAnesthe" type="text" value="<?php echo $sqldata['Anesthesiste']; ?>"/><center></td>
		</tr>	
		
		<!--BOUTONS-->
		
			   <tr height="60">
	   	<td colspan="2"><center>
	   		<table cellpadding="0" cellspacing="0" border="0">
			
	   			<tr>
	   				<td valign="top">
					<input type="hidden" name="IdAnesthe" value="<?php echo $sqldata['IdAnesthe'];?>"/>
					<input type="submit" value="Enregistrer Modifications" name="newAnesthe"/>&nbsp;&nbsp;
					</td>
						
					<td>
					<input type="submit" value="Supprimer" name="supprimerAnesthe"/>&nbsp;&nbsp;
					
					</td>

				</tr>
				</form>
	   		</table></center>
		</td>
	   </tr>
		
	</table>
	
	
	
	
	
	
	
	</div>
	
<?php
include("footer.html");
mysql_close();
?>