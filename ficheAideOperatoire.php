<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


//requete permettant d'enregistrer les modifications Aide Operatoire
if(isset ($_POST['newAideOp']))
{
	$AideOp = $_POST['aideOp'];
	$queryModifAideOp = "UPDATE `Aide_Operatoire` SET `AideOperatoire` = '$AideOp' WHERE `IdAideOp` = '".$_POST['IdAideOp']."';";
	$queryModifAideOpResult = mysql_query($queryModifAideOp);
	header("Location:administrationAideOperatoire.php");
}

//requete permettant de supprimer une aide operatoire
if(isset ($_POST['supprimerAideOp']))
{
$querySupprimer = "DELETE FROM `Aide_Operatoire` WHERE `IdAideOp` = '".$_POST['IdAideOp']."';";
$querySupprimerResult = mysql_query($querySupprimer);
header("Location:administrationAideOperatoire.php");
}

//requete permettant de recuperer l'aide operatoire concerne
if(isset($_GET['IdAideOp']))
{
	$queryAideOp = "SELECT * FROM Aide_Operatoire WHERE `IdAideOp`= '".$_GET['IdAideOp']."';";
	$queryAideOpResult = mysql_query($queryAideOp);
	$sqldata = mysql_fetch_array($queryAideOpResult);
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
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationMasterCro.php" style="text-decoration:none;">Retour administration CRO</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationAideOperatoire.php" style="text-decoration:none;">Retour administration aide opératoire</a></td>
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
			<td colspan="4"><strong>Aide Opératoire: </strong><input name="aideOp" type="text" value="<?php echo $sqldata['AideOperatoire']; ?>"/><center></td>
		</tr>	
		
		<!--BOUTONS-->
		
			   <tr height="60">
	   	<td colspan="2"><center>
	   		<table cellpadding="0" cellspacing="0" border="0">
			
	   			<tr>
	   				<td valign="top">
					<input type="hidden" name="IdAideOp" value="<?php echo $sqldata['IdAideOp'];?>"/>
					<input type="submit" value="Enregistrer Modifications" name="newAideOp"/>&nbsp;&nbsp;
					</td>
						
					<td>
					<input type="submit" value="Supprimer" name="supprimerAideOp"/>&nbsp;&nbsp;
					
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