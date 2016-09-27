<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");



//requete permettant d'ajouter une Aide Operatoire

if(isset($_POST['newAideOp']))
{
$AideOp = $_POST['aideOp'];
$queryAideOp = "INSERT INTO `Aide_Operatoire` (`AideOperatoire`) VALUES('$AideOp');";
$queryAideOpResult = mysql_query($queryAideOp);
header("Location:administrationAideOperatoire.php");
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
	
<!--FICHE AIDE OPERATOIRE-->
	<table width="600" cellpadding="3" cellspacing="3" border="0">
	<form method="post" >
		<tr>
			<td colspan="4"><strong>Aide Opératoire : </strong><input name="aideOp" type="text"/><center></td>
		</tr>	
		
		<!--BOUTONS-->
		
			   <tr height="60">
	   	<td colspan="2"><center>
	   		<table cellpadding="0" cellspacing="0" border="0">
			
	   			<tr>
	   				<td valign="top">
					<input type="hidden" name="IdAideOp" value="<?php echo $sqldata['IdAideOp'];?>"/>
					<input type="submit" value="Enregistrer" name="newAideOp"/>&nbsp;&nbsp;
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