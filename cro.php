<?php

Require("connexionBDD.php");
session_start();
Require("Auth.inc.php");


$sqlinfospatient = "SELECT Id, Nom, Prenom FROM Patients WHERE Id='".$_GET['PatientId']."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata = mysql_fetch_array($sqlresult);

$sqlinfosCro = "SELECT Titre , CONCAT(Titre,'#&#',Texte) 'value' FROM `CRO`;";
	$sqlresultCro = mysql_query($sqlinfosCro);
	$options = "";
	while($sqldataCro = mysql_fetch_array($sqlresultCro))
	{
		$options .= "<option value=\"".$sqldataCro['value']."\">";
		$options .= $sqldataCro['Titre'];
		$options .= "</option>";
	}
	
	$sqlinfosClinique = "SELECT * FROM `Cliniques`;";
	$sqlresultClinique  = mysql_query($sqlinfosClinique );
	while($sqldataClinique = mysql_fetch_array($sqlresultClinique))
	{
		$optionsClinique .= "<option value=\"".$sqldataClinique['Clinique']."\">";
		$optionsClinique .= $sqldataClinique['Clinique'];
		$optionsClinique .= "</option>";
	}
	
	$sqlinfosAO = "SELECT * FROM `Aide_Operatoire`;";
	$sqlresultAO  = mysql_query($sqlinfosAO);
	while($sqldataAO = mysql_fetch_array($sqlresultAO))
	{
		$optionsAO .= "<option value=\"".$sqldataAO['AideOperatoire']."\">";
		$optionsAO .= $sqldataAO['AideOperatoire'];
		$optionsAO .= "</option>";
	}
	
	$sqlinfosAN = "SELECT * FROM `Anesthesistes`;";
	$sqlresultAN  = mysql_query($sqlinfosAN);
	while($sqldataAN = mysql_fetch_array($sqlresultAN))
	{
		$optionsAN .= "<option value=\"".$sqldataAN['Anesthesiste']."\">";
		$optionsAN .= $sqldataAN['Anesthesiste'];
		$optionsAN .= "</option>";
	}
	
	
	
	
	
	
if(isset($_POST['Valider']))
{
	//insertion des donnees dans la BDD CROPatients
	extract($_POST);
	$jour = substr($dateInter, 0, 2);
	$mois = substr($dateInter, 3, 2);
	$annee = substr($dateInter, 6, 4);
	$datenew = "$annee-$mois-$jour";
	
	$idPatient = $sqldata['Id'];
	$sql = "INSERT INTO `CROPatients` (`Id`, `PatientId`, `DateInter`, `Clinique`, `Chirurgien`, `Anesthesiste`, `AideOp`, `Titre`, `Texte`)";
	$sql .= " VALUES (NULL, '$idPatient', '$datenew', '$clinique', '$chirurgien', '$anesthesiste', '$aideOp', '$titre', '$textecro');";
	$sqlajout=mysql_query($sql);
	
	//Retour a l'index
	header("Location:croManager.php?PatientId=".$idPatient."");
}



include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">

	<table width="630" cellpadding="3" cellspacing="3" border="0">
		
		<tr>
			<td colspan="4"><center>
				<table border="0" cellspacing="0" cellpadding="0">
				    <tr>
				        <td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
				        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="croManager.php?PatientId=<?php echo $sqldata['Id']; ?>" style="text-decoration:none;">Retour gestion CRO</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $sqldata['Id']; ?>" style="text-decoration:none;">Retour fiche patient</a></td>
				        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center></td>
		</tr>
		<tr height="100px">
	   		<td colspan="4" valign="top"><center><h3>Compte Rendu d'Op&eacute;ration</h3></center></td>
	   	</tr>
		</table>
		<table width="630" cellpadding="3" cellspacing="3" border="0">
			<form method="Post">
			<!-- action="pdf.php" target="_blanck" -->
			<tr>
				<td width="150">
					<label>Nom du patient</label> : 
				</td>
				<td>
					<input type="hidden" value="<?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?>" name="NomPrenom" />
					<?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?>
				</td>
				<td>&nbsp;&nbsp;</td>
				<td width="120">
					<label for="chirurgien">Chirurgien</label> :
				</td>
				<td>
					<input type="text" name="chirurgien" id="chirurgien" value="Dr Bellity">
				</td>
			</tr>
			<tr>
				<td width="150">
					<label for="dateInter">Date d'intervention</label> :
				</td>
				<td>
					<input type="text" name="dateInter" id="dateInter" size="10px"/> <input type="hidden" ><img src="images/iconeCalendrier.png" OnClick="InsertDateIntoDateInter();" /> </input>
				</td>
				<td>&nbsp;&nbsp;</td>
				<td width="120">
					<label for="anesthesiste">Anesth&eacute;siste</label> : 
				</td>
				<td>
						<select name="anesthesiste" id="anesthesiste"><?php echo $optionsAN;?></select>
				</td>
			</tr>
			<tr>
				<td width="150">
					<label for="clinique">Clinique</label> : 
				</td>
				<td>
					<select name="clinique" id="clinique"><?php echo $optionsClinique;?></select>
				</td>
				<td>&nbsp;&nbsp;</td>
				<td width="120">
					<label for="aideOp">Aide-op&eacute;ratoire</label> : 
				</td>
				<td>
					<select name="aideOp" id="aideOp"><?php echo $optionsAO;?></select>
				</td>
			</tr>
		</table>
		<table width="630" cellpadding="3" cellspacing="3" border="0">
			<tr>
				<td colspan="4"><label for="choixModel">Choix du model</label> : 
					<select name="choixModel" id="choixModel">
						<?php echo $options; ?>
				   </select>
				   <input type="button" onclick="FunctionDisplayCro();" name="maj" value="Mettre &agrave; jour le model"/>
			   </td>
			</tr>
			<tr>
				<td colspan="4">Titre&nbsp;:&nbsp;<center><input type="text" name="titre" id="titre" title="titre"></center></td>
			</tr>
			<tr>
				<td colspan="4"><center>Inserer la date : <img src="images/iconeCalendrier.png" OnClick="DisplayTextNonHtlm('textecro');" style="cursor:pointer;"/><br /><textarea cols="70" rows="25" name="textecro" id="textecro"></textarea></center></td>
			</tr>
			<tr>
				<td colspan="4"><center><input type="submit" name="Valider" value="Valider"/><form></center></td>
			</tr>
			<tr>
				<td id="ancre" colspan="4"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
		   </tr>
		   
	</table>

</div>

<?php
include("footer.html");
?>