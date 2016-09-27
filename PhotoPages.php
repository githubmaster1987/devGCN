<?php 
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

if(!isset($_GET['IdPhoto']))
	{
		header("Location:index.php");
	}


include("header.html");
$sqlphoto = "SELECT p.Id, p.Nom, p.Prenom, pp.IdPhoto, pp.Nom 'ImageName', pp.Lien "
        . " FROM `PhotosPatients` pp, `Patients` p"
        . " Where pp.IdPatient = p.Id"
        . " And pp.`IdPhoto` = '" . $_GET['IdPhoto'] . "'"; 
$resphoto = mysql_query($sqlphoto);

$dataphoto = mysql_fetch_array($resphoto)
?>



		<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
			<center>
				<table border="0" cellspacing="0" cellpadding="0">
				    <tr>
				        <td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
				        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ficheVierge.php" style="text-decoration:none;">Nouvelle fiche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="recherche.php" style="text-decoration:none;">Recherche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $dataphoto['Id']; ?>" style="text-decoration:none;">Retour fiche patient</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ManagePhoto.php?PatientId=<?php echo $dataphoto['Id']; ?>" style="text-decoration:none;">Retour gestion photos</a></td>
				        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center><br/><br/>
			<center><h3>Photo de <?php echo strtoupper($dataphoto['Nom'])." ". ucfirst(strtolower($dataphoto['Prenom'])) ?></h3><br /><br /></center>
			Nom de la photo : <?php echo $dataphoto['ImageName']; ?><br/><br/>
			<img id="photo" src="photospatients/<?php echo $dataphoto['Lien']; ?>"><br /><br />
			<center><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></center>
		</div>
		

<?php 
mysql_close();
include("footer.html");
?>