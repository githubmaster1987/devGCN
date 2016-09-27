<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


//requete permettant d'enregistrer les modifications CROs
if(isset ($_POST['modifInfoCRO']))
{
	$titre = $_POST['titrecro'];
	$texte = $_POST['textecro'];
	$queryModifCRO = "UPDATE `CRO` SET `Titre` = '$titre', `Texte` = '$texte' WHERE `CRO_Id` = '".$_POST['CRO_Id']."';";
	$querryModifCROResult = mysql_query($queryModifCRO);
	header("Location:administrationCRO.php");
}

//requete permettant de supprimer un CRO
if(isset ($_POST['supprimerCRO']))
{
$querySupprimer = "DELETE FROM `CRO` WHERE `CRO_Id` = '".$_POST['CRO_Id']."';";
$querySupprimerResult = mysql_query($querySupprimer);
header("Location:administrationCRO.php");
}


//requete permettant de recuperer le CRO concerné
if(isset($_GET['CRO_Id']))
{
	$queryCRO = "SELECT * FROM CRO WHERE `CRO_Id`= '".$_GET['CRO_Id']."';";
	$queryCROResult = mysql_query($queryCRO);
	$sqldata = mysql_fetch_array($queryCROResult);
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
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationMasterCro.php" style="text-decoration:none;">Retour administration CRO</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationCRO.php" style="text-decoration:none;">Retour mod&egrave;le CRO</a></td>
							<td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
						</tr>
					</table>
	   	</center></td>
			</tr>
   
		</table>
	
<!--FICHE CRO-->
	<table width="600" cellpadding="3" cellspacing="3" border="0">
	<form method="post" >
		<tr>
			<td colspan="4"><strong>Titre : </strong><input name="titrecro" type="text" value="<?php echo $sqldata['Titre']; ?>"/><center></td>
		</tr>
		<tr>
			<td colspan="4"><center><textarea cols="70" rows="25" name="textecro" id="textecro"><?php echo $sqldata['Texte'];?></textarea></center></td>
		</tr>
	
		
		<!--BOUTONS-->
		
			   <tr height="60">
	   	<td colspan="2"><center>
	   		<table cellpadding="0" cellspacing="0" border="0">
			
	   			<tr>
	   				<td valign="top">
					<input type="hidden" name="CRO_Id" value="<?php echo $sqldata['CRO_Id'];?>"/>
					<input type="submit" value="Enregistrer modifications" name="modifInfoCRO"/>&nbsp;&nbsp;
					</td>
					
					<td>
					<input type="hidden" name="CRO_Id" value="<?php echo $sqldata['CRO_Id'];?>"/>
					<input type="hidden" name="PatientID"  value="<?php echo $sqldata['Id']; ?>" ><input type="submit" value="Supprimer" name="supprimerCRO"/>&nbsp;&nbsp;
					
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