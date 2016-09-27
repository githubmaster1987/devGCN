<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


if(isset($_GET['Id']))
{
	$sql = "Select * From `CROPatients`  Where `Id` = '". $_GET['Id']."' LIMIT 1;";	
	$sqlRecup=mysql_query($sql);
	$sqldata = mysql_fetch_array($sqlRecup);
	$dateInter = $sqldata['DateInter'];
	$jour = substr($dateInter, 8, 2);
	$mois = substr($dateInter, 5, 2);
	$annee = substr($dateInter, 0, 4);
	$datefr = "$jour/$mois/$annee";

	$sqlinfospatient = "SELECT Id, Nom, Prenom FROM Patients WHERE Id='".$sqldata['PatientId']."'";
	$sqlresult = mysql_query($sqlinfospatient);
	$sqldatainfospatient = mysql_fetch_array($sqlresult);
}else
{
	header("Location:index.php");
}

$sqlinfosCro = "SELECT Titre , CONCAT(Titre,'#&#',Texte) 'value' FROM `CRO`;";
	$sqlresultCro = mysql_query($sqlinfosCro);
	$options = "";
	while($sqldataCro = mysql_fetch_array($sqlresultCro))
	{
		$options .= "<option value=\"".$sqldataCro['value']."\">";
		$options .= $sqldataCro['Titre'];
		$options .= "</option>";
	}

if(isset($_POST['enregistrer']))
{
	extract($_POST);
	$jour = substr($dateInter, 0, 2);
	$mois = substr($dateInter, 3, 2);
	$annee = substr($dateInter, 6, 4);
	$datenew = "$annee-$mois-$jour";
	$sqlenregistrer = "UPDATE `CROPatients` SET `DateInter` = '$datenew', `Clinique` = '$clinique', `Chirurgien` = '$chirurgien', `Anesthesiste` = '$anesthesiste', `AideOp` = '$aideOp', `Titre` = '$titre', `Texte` = '$textecro' WHERE `CROPatients`.`Id` = '".$sqldata['Id']."' LIMIT 1;";
	$sqlupdate=mysql_query($sqlenregistrer);
	header("Location:croManager.php?PatientId=".$sqldata['PatientId']."");
}


include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">

	<table width="600" cellpadding="3" cellspacing="3" border="0">
		
		<tr>
			<td colspan="4"><center>
				<table border="0" cellspacing="0" cellpadding="0">
				    <tr>
				        <td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
				        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="croManager.php?PatientId=<?php echo $sqldata['PatientId']; ?>" style="text-decoration:none;">Retour gestion CRO</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $sqldata['PatientId']; ?>" style="text-decoration:none;">Retour fiche patient</a></td>
				        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center></td>
		</tr>
		<tr height="100px">
	   		<td colspan="4" valign="top"><center><h3>Compte Rendu d'Op&eacute;ration</h3></center></td>
	   	</tr>
		</table>
		<table width="600" cellpadding="3" cellspacing="3" border="0">
			<form method="Post">
			<!-- action="pdf.php" target="_blanck" -->
			<tr>
				<td>
					<label>Nom du patient</label> : 
				</td>
				<td>
					<input type="hidden" value="<?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?>" name="NomPrenom" />
					<?php echo strtoupper($sqldatainfospatient['Nom'])." ". ucfirst(strtolower($sqldatainfospatient['Prenom'])) ?>
				</td>
				<td>&nbsp;&nbsp;</td>
				<td>
					<label for="chirurgien">Chirurgien</label> :
				</td>
				<td>
					<input type="text" name="chirurgien" id="chirurgien" value="<?php echo $sqldata['Chirurgien']; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="dateInter">Date d'intervention</label> :
				</td>
				<td>
					<input type="text" name="dateInter" id="dateInter" value="<?php echo $datefr; ?>">
				</td>
				<td>&nbsp;&nbsp;</td>
				<td>
					<label for="anesthesiste">Anesth&eacute;siste</label> : 
				</td>
				<td>
					<input type="text" name="anesthesiste" id="anesthesiste" value="<?php echo $sqldata['Anesthesiste']; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="clinique">Clinique</label> : 
				</td>
				<td>
					<input type="text" name="clinique" id="clinique" value="<?php echo $sqldata['Clinique']; ?>">
				</td>
				<td>&nbsp;&nbsp;</td>
				<td>
					<label for="aideOp">Aide-op&eacute;ratoire</label> : 
				</td>
				<td>
					<input type="text" name="aideOp" id="aideOp" value="<?php echo $sqldata['AideOp']; ?>">
				</td>
			</tr>
		</table>
		<table width="600" cellpadding="3" cellspacing="3" border="0">
			<tr>
				<td colspan="4"><label for="choixModel">Choix du model</label> : 
					<select name="choixModel" id="choixModel">
						<option value="<?php echo $sqldata['Titre']; ?>"><?php echo $sqldata['Titre']; ?></option>
						<?php echo $options; ?>
				   </select>
				   <input type="button" onclick="FunctionDisplayCro();" name="maj" value="Mettre &agrave; jour le model"/>
			   </td>
			</tr>
			<tr>
				<td colspan="4">Titre&nbsp;:&nbsp;<center><input type="text" name="titre" id="titre" title="titre" value="<?php echo $sqldata['Titre']; ?>"></center></td>
			</tr>
			<tr>
				<td colspan="4"><center><textarea cols="70" rows="25" name="textecro" id="textecro"><?php echo $sqldata['Texte']; ?></textarea></center></td>
			</tr>
			<tr>
				<td colspan="4"><center><input type="submit" name="enregistrer" value="Enregistrer les modifications"/><form></center></td>
			</tr>
			<tr>
				<td id="ancre" colspan="4"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
		   </tr>
		   
	</table>

</div>

<?php
include("footer.html");
?>