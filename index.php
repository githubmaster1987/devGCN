<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


 
include("header.html");

$sqllastpatient = "SELECT Id, Nom, Prenom FROM Patients ORDER BY DateCrea DESC LIMIT 15;";
$sqlrecup = mysql_query($sqllastpatient);
while($sqldata = mysql_fetch_array($sqlrecup)){
	$last[]="<li><a style=\"color:#5782af;text-decoration:none;\" href = \"fichePatient.php?PatientID=".$sqldata['Id']."\">".strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom']))."</a></li>";
}
?>
 
<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">

	<table width="500" cellpadding="0" cellspacing="0">
		
		<tr height="100px">
	   		<td colspan="3" valign="top"><center><h3>Accueil Gestion Cabinet M&eacute;dical</h3></center></td>	
	   	</tr>
		<tr>
			<td colspan="3" height="60" valign="top"><center>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;" ><a href="administration.php" style="text-decoration:none;">Administration</a>&nbsp;&nbsp;<font style="color:#5c5c5c;">|</font>&nbsp;&nbsp;<a href="recherche.php" style="text-decoration:none;">Recherche</a>&nbsp;&nbsp;<font style="color:#5c5c5c;">|</font>&nbsp;&nbsp;<a href="ficheVierge.php" style="text-decoration:none;">Nouvelle fiche</a></td>
							<td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
						</tr>
					</table>
	   		</center></td>
		</tr>
		<tr>
			<td rowspan="2">
				<fieldset>
				<legend><font style="color:#5782af;">Derniers patients enregistr&eacute;s :</font></legend>
				<ul>
					<?php for($i=0;$i<sizeof($last);$i++){echo $last[$i];}  ?>
				</ul>
				</fieldset>
			</td>
			<td style="padding-right:50px;"></td>
			<td valign="top">
			
			<form action="recherche.php" method="get">
			<label for="recherche">Recherche :</label><br />
			<input type="text" name="recherche"/> <input type="submit" name="chercher" value="Chercher"/><br />
			<input type="radio" name="RechercheType" value="0" checked/> Nom<br />
			<input type="radio" name="RechercheType" value="1"/> Notes<br />
			<input type="radio" name="RechercheType" value="2"/> Tous
			</form>
			
			</td>
		</tr>

	</table>

</div>

<?php
include("footer.html");
?>