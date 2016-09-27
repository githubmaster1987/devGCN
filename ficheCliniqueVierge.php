<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");




//requete permettant d'ajouter une Clinique

if(isset($_POST['newClinique']))
{
$Clinique = $_POST['nomClinique'];
$addClinique = $_POST['addClinique'];
$cpClinique = $_POST['cpClinique'];
$villeClinique = $_POST['villeClinique'];
$telClinique = $_POST['telClinique'];
$faxClinique = $_POST['faxClinique'];
$queryClinique = "INSERT INTO `Cliniques` (`Clinique`, `Adresse`, `CP`, `Ville`, `Tel`, `Fax`) VALUES(\"$Clinique\",\"$addClinique\",\"$cpClinique\",\"$villeClinique\",\"$telClinique\",\"$faxClinique\");";
$queryCliniqueResult = mysql_query($queryClinique);
header("Location:administrationClinique.php");
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
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationCRO.php" style="text-decoration:none;">Retour Administration CRO</a></td>
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
			<td><strong>Nom Clinique : </strong></td><td><input name="nomClinique" size="30" type="text"/><center></td>
		</tr>
		<tr>
			<td><strong>Adresse : </strong></td><td><input name="addClinique" type="text" size="30"/><center></td>
		</tr>
		<tr>
			<td><strong>CP : </strong></td><td><input name="cpClinique" type="text"  size="30"/><center></td>
		</tr>
		<tr>
			<td><strong>Ville : </strong></td><td><input name="villeClinique" type="text" size="30"/><center></td>
		</tr>
		<tr>
			<td><strong>Tel : </strong></td><td><input name="telClinique" type="text" size="30"/><center></td>
		</tr>
		<tr>
			<td><strong>Fax : </strong></td><td><input name="faxClinique" type="text" size="30" value=""/><center></td>
		</tr>	
		<!--BOUTONS-->
		
			   <tr height="60">
	   	<td colspan="2"><center>
	   		<table cellpadding="0" cellspacing="0" border="0">
			
	   			<tr>
	   				<td valign="top">
					<input type="hidden" name="IdClinique" value="<?php echo $sqldata['IdClinique'];?>"/>
					<input type="submit" value="Enregistrer" name="newClinique"/>&nbsp;&nbsp;
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