<?php 
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

include("header.html");


$Lettre = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$lien = "";

for ($i=0; $i<26; $i++) {
	$lien = $lien  .  "<a style=\"color:#5782af;text-decoration:none;\" href=\"recherche.php?recherche=".$Lettre[$i]."&chercher=Chercher\">".$Lettre[$i]."</a>&nbsp;-&nbsp;";
}
$lien = substr($lien, 0, (strlen($lien)-7));

//requ�te pour la recherche
if(isset($_GET['recherche']))
{
$Exist = " ";
if($_GET['RechercheType'] == 1)
{
	$queryRecherche = "SELECT * FROM `Patients` WHERE `Notes` LIKE '%".$_GET['recherche']."%' ORDER BY Nom ;";
}

if($_GET['RechercheType'] == 0)
{
$queryRecherche = "SELECT * FROM `Patients` WHERE `Nom` LIKE '".$_GET['recherche']."%' ORDER BY Nom ;";
}

if($_GET['RechercheType'] == 2)
{
$queryRecherche = "SELECT * FROM `Patients` WHERE `Nom` LIKE '%".$_GET['recherche']."%' OR  `Prenom` LIKE '%".$_GET['recherche']."%' OR  `Profession` LIKE '%".$_GET['recherche']."%' OR  `Adresse` LIKE '%".$_GET['recherche']."%' OR  `Cp` LIKE '%".$_GET['recherche']."%' OR `Ville` LIKE '%".$_GET['recherche']."%' OR  `Pays` LIKE '%".$_GET['recherche']."%' OR  `Langue` LIKE '%".$_GET['recherche']."%' OR  `DateN` LIKE '%".$_GET['recherche']."%' OR  `Motif` LIKE '%".$_GET['recherche']."%' OR  `Notes` LIKE '%".$_GET['recherche']."%' ORDER BY Nom ;";
}



$queryRechercheResult = mysql_query($queryRecherche);
}

?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
		<table width="400" cellpadding="2" cellspacing="2">
			<tr>
				<td colspan="3"><center>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ficheVierge.php" style="text-decoration:none;">Nouvelle fiche</a></td>
							<td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
						</tr>
					</table>
				</center>
			</td>
			</tr>
			
			<!-- <tr>
				<td><br /><br /><?php echo $lien;?><br /></td>
			</tr> -->
			<tr height="20px"></tr>
			<tr>
			<td>
			<center>
			<form method="get" action="recherche.php">
			<label for="recherche">Nouvelle recherche :</label>
			<input type="text" name="recherche"/> <input type="submit" name="chercher" value="Chercher"/><br />
			<input type="radio" name="RechercheType" value="0" checked/> Nom &nbsp;&nbsp;&nbsp;&nbsp;	<input type="radio" name="RechercheType" value="1"/> Notes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="RechercheType" value="2"/> Tous
			</form>
			</center>
			</td>
			</tr>
			<tr height="100px">
				<td><center><h3>Recherche de : "<?php echo $_GET['recherche'];?>"</h3></center></td>
			</tr>
				<?php if(isset($recherche)):
					
					foreach($_GET as $key => $value)
					{
						$link .= $key."=".$value."&";
					}
					endif; 
					?>
					<!-- <tr>
						<td><a href="generation_mail.php?<?php echo $link; ?>">Generateur de mail</a><br/></td>
					</tr>-->

				<?php ?>
				
				<tr>
				<td>
					<fieldset>
					<legend><font style="color:#5782af;">R&eacute;sultat de la recherche : </font></legend>
					<table width="400" cellpadding="0" cellspacing="0">
					<?php
					//controle pour savoir si la recherche renvoi quelque chose ou non
					if(isset($Exist))
						{
						$rows = mysql_num_rows($queryRechercheResult);
						}

					if($rows == 0)
					{
					echo "<tr><td>Aucune entr&eacute;e ne correspond &agrave; votre recherche.</td></tr>";
					}
					else
					{
					$count = 1;
					while($sqldata = mysql_fetch_array($queryRechercheResult))
					{	
						if (is_int($count / 50)) {
						 echo "<td><td>&nbsp;</td></tr>";
						 echo "<tr><td id=\"ancre\" align=\"right\"><a href=\"#haut_page\" style=\"color:#5782af;text-decoration:none\">Haut de page <img src=\"images/arrow_up.png\" width=\"10\" height=\"10\" border=\"0\"/></a></td></tr>";
						 echo "<td><td>&nbsp;</td></tr>";
						}
						echo "<tr><td width=\"400\"><a style=\"color:#5782af;text-decoration:none;\" href = \"fichePatient.php?PatientID=".$sqldata['Id']."\">&bull;&nbsp;".strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom']))."</a></td></tr>";
						$count = $count + 1;
						}
					}?>
					</table>
					</fieldset>
				</td>
				</tr>
		
			
	   <tr>
	   	<td id="ancre"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
	   </tr>
   
		</table>
   
   
   
</div>


<?php 
mysql_close();
include("footer.html");

?>