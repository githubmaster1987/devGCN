<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


include("header.html");

?>
	
	<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
		<table width="500" cellpadding="2" cellspacing="2">
			<tr>
				<td height="60"><center>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ficheVierge.php" style="text-decoration:none;">Nouvelle fiche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administration.php" style="text-decoration:none;">Retour administration</a></td>
							<td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
						</tr>
					</table>
	   	</center></td>
			</tr>
			
			<tr height="100px">
		   		<td valign="top"><center><h3>Administration CRO</h3></center></td>	
		   	</tr>
			
			<tr>
			<td><center><a href="administrationCRO.php" style="color:#5782af;text-decoration:none">Administration Mod�le CRO</a></center></td>
			</tr>
			<tr>
			<td><center><a href="administrationClinique.php" style="color:#5782af;text-decoration:none">Administration Clinique</a></center></td>
			</tr>
			<tr>
			<td><center><a href="administrationAnesthesiste.php" style="color:#5782af;text-decoration:none">Administration Anesthesiste</a></center></td>
			</tr>
			<tr>
			<td><center><a href="administrationAideOperatoire.php" style="color:#5782af;text-decoration:none">Administration Aide Op�ratoire</a></center></td>
			</tr>

		
			
	   <tr>
	   	<td id="ancre"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
	   </tr>
   
		</table>
   
   
   
</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

<?php
include("footer.html");
?>