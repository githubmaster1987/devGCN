<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

include("header.html");

//requete pour recuperer tous les CROs
$queryCRO = "SELECT * FROM CRO;";
$queryCROResult = mysql_query($queryCRO);
while($sqldata = mysql_fetch_array($queryCROResult)){
	$affiche[] = "<li><a style=\"color:#5782af;text-decoration:none;\" href = \"ficheCRO.php?CRO_Id=".$sqldata['CRO_Id']."\">".$sqldata['Titre']."</a></li>";
}
?>
	
	
		<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
		<table cellpadding="2" cellspacing="2">
			<tr>
				<td colspan="3"><center>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administration.php" style="text-decoration:none;">Retour page administration</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationMasterCro.php" style="text-decoration:none;">Retour page administration CRO</a></td>
							<td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
						</tr>
					</table>
					</center>
				</td>
			</tr>
   
		</table>
   


	<table width="500" cellpadding="0" cellspacing="0">
		
		<tr height="120px">
	   		<td valign="top"><center><h3>Administration Mod&egrave;le CRO</h3></center></td>	
	   	</tr>
		<tr>
			<td>
				<fieldset>
				<legend><font style="color:#5782af;">Listes des CROs : </font></legend>
				<ul>
					<?php for($i=0;$i<sizeof($affiche);$i++){echo $affiche[$i];}  ?>
				</ul>
				</fieldset>
			</td>
		</tr>
		
		<tr height="50">
		<td><input type="button" value="Ajouter CRO" onclick="redirAjoutCRO()"/></td>
		</tr>
		
		<tr>
	   	<td id="ancre"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
	   </tr>
		
	</table>

</div>
	

<?php
include("footer.html");
mysql_close();
?>