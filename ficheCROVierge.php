<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


//requete permettant d'ajouter un CRO

if(isset($_POST['newCRO']))
{
$titre = $_POST['titrecro'];
$texte = $_POST['textecro'];
$queryCRO = "INSERT INTO `CRO` (`Titre`, `Texte`) VALUES('$titre', '$texte');";
$queryCROResult = mysql_query($queryCRO);
header("Location:administrationCRO.php");
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
			<td colspan="4"><strong>Titre : </strong><input name="titrecro" type="text"/><center></td>
		</tr>
		<tr>
			<td colspan="4"><center><textarea cols="70" rows="25" name="textecro" id="textecro"></textarea></center></td>
		</tr>
	
		
		<!--BOUTONS-->
		
			   <tr height="60">
	   	<td colspan="2"><center>
	   		<table cellpadding="0" cellspacing="0" border="0">
			
	   			<tr>
	   				<td valign="top">
					<input type="hidden" name="CRO_Id" value="<?php echo $sqldata['CRO_Id'];?>"/>
					<input type="submit" value="Enregistrer" name="newCRO"/>&nbsp;&nbsp;
					</td>
					
					<td>
					<input type="reset" value="Vider les champs"/>&nbsp;&nbsp;
					
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