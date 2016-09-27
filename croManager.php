<?php 
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


//code pour le bouton supprimer
if(isset($_GET['action']) && ($_GET['action'] == "del")){
	$queryCRO = "DELETE FROM `CROPatients` WHERE `Id`= '".$_GET['IdCRO']."';";
	$resultCRO= mysql_query($queryCRO);
	header("Location:croManager.php?PatientId=".$_GET['PatientId']);
}

$sqlinfospatient = "SELECT Id, Nom, Prenom FROM Patients WHERE Id='".$_GET['PatientId']."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata = mysql_fetch_array($sqlresult);



//requete pour recuperer tous les CROs du patient
$queryCROPatients = "SELECT * FROM CROPatients WHERE PatientId='".$_GET['PatientId']."' ORDER BY DateInter;";
$queryCROPatientsResult = mysql_query($queryCROPatients);
while($sqldataCRO = mysql_fetch_array($queryCROPatientsResult))
{
	//Affichage de la date au format JJ/MM/AAAA
	$date = $sqldataCRO['DateInter'];
	$jour = substr($date, 8, 2);
	$mois = substr($date, 5, 2);
	$annee = substr($date, 0, 4);
	$datenew = "$jour/$mois/$annee";
	//Affichage du lien vers le CRO
	$affiche[] = "<a style=\"color:#5782af;text-decoration:none;\" href = \"pdf.php?IdCRO=".$sqldataCRO['Id']."\">$datenew - ".$sqldataCRO['Titre']."</a>";
	$DelLien[] = "&nbsp;&nbsp;<a onclick=confirmDel('croManager.php?PatientId=".$sqldata['Id']."&action=del&IdCRO=".$sqldataCRO['Id']."') href=\"#\"><img src=\"images/cancel.png\" title=\"Supprimer\" border=\"0\" width=\"16\" height=\"16\"></a>";
}

include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
   
   <table cellpadding="2" cellspacing="2">
   
   	   <tr>
			<td><center>
				<table border="0" cellspacing="0" cellpadding="0">
				    <tr>
				        <td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
				        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ficheVierge.php" style="text-decoration:none;">Nouvelle fiche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="recherche.php" style="text-decoration:none;">Recherche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $_GET['PatientId']; ?>" style="text-decoration:none;">Retour fiche patient</a></td>
				        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center></td>
		</tr>
	   <tr height="100px">
   			<td><center><h3>Gestion des CRO de "<?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?>"</h3></center></td>	
   	   </tr>
	   <tr height="60">
	   	<td><center><input type="button" onclick="redirCRO()" value="Ajouter un CRO pour <?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?>"/></center></td>
	   </tr>
	   <tr>
			<td>
				<fieldset>
				<legend><font style="color:#5782af;">Listes des CROs du patient :</font></legend>
				<table border="0" cellspacing="0" cellpadding="0">
					<?php for($i=0;$i<sizeof($affiche);$i++)
					{
						echo "<tr><td>&bull;&nbsp;" .$affiche[$i].' </td><td> '.$DelLien[$i] ."</td></tr>";
					}
					?>
				</table>
				</fieldset>
			</td>
		</tr>
	   <tr>
	   	<td id="ancre" height="60"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
	   </tr>
   
   </table>
   
</div>
   
<?php 
mysql_close();
include("footer.html");
?>