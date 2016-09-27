<?php

Require("connexionBDD.php");
session_start();
Require("Auth.inc.php");


$sqlinfospatient = "SELECT Id, Nom, Prenom FROM Patients WHERE Id='".$_GET['PatientId']."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata = mysql_fetch_array($sqlresult);

$sqlinfosDevis = "SELECT * FROM `Devis`;";
	$sqlresultDevis = mysql_query($sqlinfosDevis);
	$sqldataDevis = mysql_fetch_array($sqlresultDevis);
	
	$sqlinfosClinique = "SELECT * FROM `Cliniques`;";
	$sqlresultClinique  = mysql_query($sqlinfosClinique );
	while($sqldataClinique = mysql_fetch_array($sqlresultClinique))
	{
		$optionsClinique .= "<option value=\"".$sqldataClinique['IdClinique']."\">";
		$optionsClinique .= $sqldataClinique['Clinique'];
		$optionsClinique .= "</option>";
	}
	
if(isset($_POST['Valider']))
{
	//insertion des donnees dans la BDD Devis
	extract($_POST);

	$idPatient = $sqldata['Id'];
	$sql = "INSERT INTO `Devis` (`Id`, `PatientId`, `Nat_Int`, `Anesthesie`, `Date_Prem_Cons`, `CliniqueId`, `Date_Int`, `Heure_Int`, `FraisCH`, `FraisHC`, `AideOp`, `FraisHA`, `FraisMat`, `Code_CCAM`, `Type_Devis`, `Date_Etab`)";
	$sql .= " VALUES (NULL, '$idPatient', '$natureint', '$anesthesie', '$datepremcons', '$clinique', '$dateint', '$heureint', '$fraisch', '$fraishc', '$aideop', '$fraisha', '$fraismat', '$ccam', '$typedevis', '$dateetab');";
	$sqlajout=mysql_query($sql);
	//Retour a l'index
	header("Location:devisManager.php?PatientId=".$_GET['PatientId']);
}



include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
   <form method="post" name="formulaire">
   
   <table cellpadding="2" cellspacing="2">
		<tr>
			<td colspan="3"><center>
				<table border="0" cellspacing="0" cellpadding="0">
				    <tr>
				        <td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
				        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="devisManager.php?PatientId=<?php echo $sqldata['Id']; ?>" style="text-decoration:none;">Retour gestion devis</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $sqldata['Id']; ?>" style="text-decoration:none;">Retour fiche patient</a></td>
				        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center></td>
		</tr>
		<tr height="100px">
   			<td colspan="2"><center><h3>Nouveau devis</h3></center></td>	
   		</tr>
        <tr>
            <td width="150">
                <label>Nom du patient</label> : 
            </td>
            <td>
                <input type="hidden" value="<?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?>" name="NomPrenom" />
                <?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?>
            </td>
        </tr>    
		<tr> <!--TYPE DEVIS-->
		   <td width="250"><label for="typedevis">Type de devis</label> : </td>
		   <td><select name="typedevis" id="typedevis">
		   	<option value="E">Vis&eacute;e esth&eacute;tique</option>
			<option value="M">Acte m&eacute;dical</option>
		   </select></td>
	   </tr>
   		<tr><!--NATURE INTERVENTION-->
		   <td><label for="natureint">Nature de l'intervention</label> : </td>
		   <td><input type="text" name="natureint" id="natureint"></td>
	   <tr>
	   
	   <tr> <!--ANESTHESIE-->
		   <td width="250"><label for="anesthesie">Anesth&eacute;sie</label> : </td>
		   <td><select name="anesthesie" id="anesthesie">
		   	<option value="sans">Sans</option>
            <option value="locale">Locale</option>
			<option value="generale">G&eacute;n&eacute;rale</option>
		   </select></td>
	   </tr>
	   
	   <tr><!--DATE PREMIERE CONSULTATION-->
		   <td><label for="datepremcons">Date premi&egrave;re consultation</label> : </td>
		   <td><input type="text" name="datepremcons" id="datepremcons"/></td>
	   </tr>
       
       <tr><!--DATE INTERVENTION-->
		   <td><label for="dateint">Date intervention</label> : </td>
		   <td><input type="text" name="dateint" id="dateint"/></td>
	   </tr>
       
       <tr><!--HEURE INTERVENTION-->
		   <td><label for="heureint">Heure intervention</label> : </td>
		   <td><input type="text" name="heureint" id="heureint"/></td>
	   </tr>
	   
	   <tr><!--FRAIS CH-->
		   <td><label for="fraisch">Frais de clinique et d'hospitalisation</label> : </td>
		   <td><input type="text" name="fraisch" id="fraisch"> &euro;</td>
	   <tr>
       
       <tr><!--FRAIS HC-->
		   <td><label for="fraishc">Honoraires du chirurgien</label> : </td>
		   <td><input type="text" name="fraishc" id="fraishc"> &euro;</td>
	   <tr>
       
       <tr><!--AIDE OP-->
		   <td><label for="aideop">Aide op&eacute;ratoire</label> : </td>
		   <td><input type="text" name="aideop" id="aideop"> &euro;</td>
	   <tr>
       
       <tr><!--FRAIS HA-->
		   <td><label for="fraisha">Frais des honoraires de l'anesth&eacute;siste</label> : </td>
		   <td><input type="text" name="fraisha" id="fraisha"> &euro;</td>
	   <tr>
       
       <tr><!--FRAIS MATERIEL-->
		   <td><label for="fraismat">Mat&eacute;riel implant&eacute;</label> : </td>
		   <td><input type="text" name="fraismat" id="fraismat"> &euro;</td>
	   <tr>
	   
	   <tr><!--CODE CCAM-->
		   <td><label for="ccam">Code CCAM</label> : </td>
		   <td><input type="text" name="ccam" id="ccam"> *</td>
	   </tr>
       <tr><!--CODE CCAM SUITE-->
		   <td colspan="2" style="text-align:right; font-style:italic; font-size:10px;">* uniquement pour les devis de type <b>acte m&eacute;dical</b></td>
	   </tr>
       
       <tr> <!--CLINQUE-->
		   <td width="250">
                <label for="clinique">Clinique</label> : 
            </td>
            <td>
                <select name="clinique" id="clinique"><?php echo $optionsClinique;?></select>
            </td>
	   </tr>
       
       <tr><!--DATE ETAB-->
		   <td><label for="dateetab">Date devis</label> : </td>
		   <td><input type="text" name="dateetab" id="dateetab"/></td>
	   </tr>
	   
	   <tr height="60"><!--BOUTONS-->
	   	<td colspan="2"><input type="submit" name="Valider" value="Valider"/>&nbsp;<input type="reset" value="Vider les champs"/></td>
	   </tr>
	   
	   <tr>
	   	<td id="ancre" colspan="2"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
	   </tr>
   
   </table>
   
   
   </form>
</div>

<?php
include("footer.html");
?>