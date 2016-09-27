<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


//requete pour recuperer toutes les cliniques
$queryClinique = "SELECT * FROM Cliniques;";
$queryCliniqueResult = mysql_query($queryClinique);
while($sqldata = mysql_fetch_array($queryCliniqueResult)){
	$affiche[] = "<li><a style=\"color:#5782af;text-decoration:none;\" href = \"ficheClinique.php?IdClinique=".$sqldata['IdClinique']."\">".$sqldata['Clinique']."</a></li>";
}

include("header.html");
?>
	
	
		<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
		<table cellpadding="2" cellspacing="2">
			<tr>
				<td colspan="3"><center>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administrationMasterCro.php" style="text-decoration:none;">Retour administration CRO</a></td>
							<td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
						</tr>
					</table>
	   	</center></td>
			</tr>
   
		</table>
   
   


	<table width="500" cellpadding="0" cellspacing="0">
		
		<tr height="120px">
	   		<td valign="top"><center><h3>Administration Cliniques</h3></center></td>	
	   	</tr>
		<tr>
			<td>
				<fieldset>
				<legend><font style="color:#5782af;">Listes des Cliniques : </font></legend>
				<ul>
					<?php for($i=0;$i<sizeof($affiche);$i++){echo $affiche[$i];}  ?>
				</ul>
				</fieldset>
			</td>
		</tr>
		
		<tr height="50">
		<td><input type="button" value="Ajouter Clinique" onclick="document.location.href='ficheCliniqueVierge.php';"/></td> <!-- A MODIFIER -->
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