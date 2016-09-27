<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

//requete permettant d'enregistrer les modifications Motif
if(isset ($_POST['newMotif']))
{
	$Motif = $_POST['nomMotif'];
	$queryModifMotif = "UPDATE `Motifs` SET `Texte` = '$Motif' WHERE `Id` = '".$_POST['IdMotif']."';";
	$queryModifMotifResult = mysql_query($queryModifMotif);
	header("Location:administrationMotifs.php");
}

//requete permettant de supprimer un Motif
if(isset ($_POST['supprimerMotif']))
{
$querySupprimer = "DELETE FROM `Motifs` WHERE `Id` = '".$_POST['IdMotif']."';";
$querySupprimerResult = mysql_query($querySupprimer);
header("Location:administrationMotifs.php");
}

//requete permettant de recuperer les motifs concerne
if(isset($_GET['Id']))
{
	$queryMotif = "SELECT * FROM Motifs WHERE `Id`= '".$_GET['Id']."';";
	$queryMotifResult = mysql_query($queryMotif);
	$sqldata = mysql_fetch_array($queryMotifResult);
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
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administration.php" style="text-decoration:none;">Retour page administration</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationMotifs.php" style="text-decoration:none;">Retour page administration motifs</a></td>
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
			<td colspan="4"><strong>Nom Motif : </strong><input name="nomMotif" type="text" value="<?php echo $sqldata['Texte']; ?>"/><center></td>
		</tr>	
		
		<!--BOUTONS-->
		
			   <tr height="60">
	   	<td colspan="2"><center>
	   		<table cellpadding="0" cellspacing="0" border="0">
			
	   			<tr>
	   				<td valign="top">
					<input type="hidden" name="IdMotif" value="<?php echo $sqldata['Id'];?>"/>
					<input type="submit" value="Enregistrer Modifications" name="newMotif"/>&nbsp;&nbsp;
					</td>
						
					<td>
					<input type="submit" value="Supprimer" name="supprimerMotif"/>&nbsp;&nbsp;
					
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