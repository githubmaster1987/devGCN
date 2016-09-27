<?php 
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");



if(isset($_GET['IdDevis']))
{
	$sql = "Select * From `Devis`  Where `Id` = '". $_GET['IdDevis']."' LIMIT 1;";	
	$sqlRecup=mysql_query($sql);
	$sqldata = mysql_fetch_array($sqlRecup);
	
	//formatage affichage du type de devis
	if($sqldata['Type_Devis'] == "M")
	{
		$Type = "Acte m&eacute;dical";
	}
	else if($sqldata['Type_Devis'] == "E")
	{
		$Type = "Vis&eacute;e esth&eacute;tique";
	}
	
	$sqlCli = "Select * From `Cliniques` Where `IdClinique` = '".$sqldata['CliniqueId']."' LIMIT 1;";	
	$sqlRecupCli=mysql_query($sqlCli);
	$sqldataCli = mysql_fetch_array($sqlRecupCli);
	
}else
{
	header("Location:index.php");
}

if(isset($_POST['enregistrer']))
{
	extract($_POST);
	$sql = "UPDATE `Devis` SET `Id` = '".$_GET['IdDevis']."', `PatientId` = '".$_GET['PatientId']."', `Nat_Int` = '$natureint', `Anesthesie` = '$anesthesie', `Date_Prem_Cons` = '$datepremcons', `CliniqueId` = '$cliniqueid', `Date_Int` = '$dateint', `Heure_Int` = '$heureint', `FraisCH` = '$fraisch', `FraisHC` = '$fraishc', `AideOp` = '$aideop', `FraisHA` = '$fraisha', `FraisMat` = '$fraismat', `Code_CCAM` = '$ccam', `Type_Devis` = '$typedevis', `Date_Etab` = '$dateetab' WHERE `Devis`.`Id` = '".$_GET['IdDevis']."' LIMIT 1;";
	$sqlupdate=mysql_query($sql);
	header("Location:ficheDevis.php?IdDevis=".$_GET['IdDevis']."&PatientId=".$_GET['PatientId']);
}

//Récupération cliniques pour liste déroulante Cliniques
$sqlinfosClinique = "SELECT * FROM `Cliniques`;";
	$sqlresultClinique = mysql_query($sqlinfosClinique);
	$options = "";
	while($sqldataClinique = mysql_fetch_array($sqlresultClinique))
	{
		$options .= "<option value=\"".$sqldataClinique['IdClinique']."\">";
		$options .= $sqldataClinique['Clinique'];
		$options .= "</option>";
	}

//requete permettant de recuperer les nom et prenom du Patient auquel appartient de devis
if(isset($_GET['PatientId']))
{
	$queryPatient = "SELECT Nom, Prenom FROM Patients WHERE `Id`= '".$_GET['PatientId']."';";
	$queryPatientResult = mysql_query($queryPatient);
	$sqldataPatient = mysql_fetch_array($queryPatientResult);
}else
{
	header("Location:index.php");
}

include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
   <form method="post" name="formulaire">
   <input type="hidden" name="PatientId" value="<?php echo $_GET['PatientId'];?>"/>
   <table cellpadding="2" cellspacing="2">
   		<tr>
			<td colspan="3"><center>
				<table border="0" cellspacing="0" cellpadding="0">
				    <tr>
				        <td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
                        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ficheDevis.php?IdDevis=<?php echo $sqldata['Id']; ?>&PatientId=<?php echo $_GET['PatientId']; ?>" style="text-decoration:none;">Retour fiche devis</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="devisManager.php?PatientId=<?php echo $_GET['PatientId']; ?>" style="text-decoration:none;">Retour gestion devis</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $_GET['PatientId']; ?>" style="text-decoration:none;">Retour fiche patient</a></td>
                        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center></td>
		</tr>
   		<tr height="100px">
   			<td colspan="2"><center><h3>Modifications du devis (<?php echo $Type;?>)<br />de <?php echo strtoupper($sqldataPatient['Nom'])." ". ucfirst(strtolower($sqldataPatient['Prenom'])) ?></h3></center></td>	
   		</tr>
		<tr height="60"><!--BOUTONS-->
	   		<td colspan="2"><center><input type="submit" name="enregistrer" value="Enregistrer les modification" onSubmit="return verifGlobale();"/>&nbsp;<input type="reset" value="Annuler les modifications"/></center></td>
	   	</tr>
	</table>
     <table cellpadding="2" cellspacing="2">
		<tr> <!--NOM PATIENT-->
		   <td width="250">
           		<label>Nom du patient</label> :
           </td>
		   <td>
                <?php echo strtoupper($sqldataPatient['Nom'])." ". ucfirst(strtolower($sqldataPatient['Prenom'])) ?>
            </td>
	   </tr>
		<tr> <!--TYPE DEVIS-->
		   <td width="250"><label for="typedevis">Type de devis</label> : </td>
		   <td><select name="typedevis" id="typedevis">
		   	<option value="<?php echo $sqldata['Type_Devis']; ?>"><?php echo $Type; ?></option>
			<option value="M">Acte m&eacute;dical</option>
			<option value="E">Vis&eacute;e esth&eacute;tique</option>
			</select></td>
	   <tr>
	   
	   <tr><!--NATURE INTERVENTION-->
		   <td><label for="natureint">Nature de l'intervention</label> : </td>
		   <td><input type="text" name="natureint" id="natureint" value="<?php echo $sqldata['Nat_Int']; ?>"></td>
	   </tr>
	   
	   <tr> <!--ANESTHESIE-->
		   <td width="250"><label for="anesthesie">Anesth&eacute;sie</label> : </td>
		   <td><select name="anesthesie" id="anesthesie">
            <option value="<?php echo $sqldata['Anesthesie'] ?>"><?php echo ucfirst(strtolower($sqldata['Anesthesie'])) ?></option>
		   	<option value="sans">Sans</option>
            <option value="locale">Locale</option>
			<option value="generale">G&eacute;n&eacute;rale</option>
		   </select></td>
	   </tr>
	   
	  <tr><!--DATE PREMIERE CONSULTATION-->
		   <td><label for="datepremcons">Date premi&egrave;re consultation</label> : </td>
		   <td><input type="text" name="datepremcons" id="datepremcons" value="<?php echo $sqldata['Date_Prem_Cons']; ?>"></td>
	   </tr>
	   
	   <tr><!--DATE INTERVENTION-->
		   <td><label for="dateint">Date intervention</label> : </td>
		   <td><input type="text" name="dateint" id="dateint" value="<?php echo $sqldata['Date_Int']; ?>"></td>
	   <tr>
	   
	   <tr><!--HEURE INTERVENTION-->
		   <td><label for="heureint">Heure intervention</label> : </td>
		   <td><input type="text" name="heureint" id="heureint" value="<?php echo $sqldata['Heure_Int']; ?>"></td>
	   </tr>
	   
	   <tr><!--FRAIS CH-->
		   <td><label for="fraisch">Frais de clinique et d'hospitalisation</label> : </td>
		   <td><input type="text" name="fraisch" id="fraisch" value="<?php echo $sqldata['FraisCH']; ?>"></td>
	   </tr>
	   
	   <tr><!--FRAIS HC-->
		   <td><label for="fraishc">Honoraires du chirurgien (HT)</label> : </td>
		   <td><input type="text" name="fraishc" id="fraishc" value="<?php echo $sqldata['FraisHC']; ?>"></td>
	   </tr>
	   
	   <tr><!--AIDE OP-->
		   <td><label for="aideop">Aide op&eacute;ratoire</label> : </td>
		   <td><input type="text" name="aideop" id="aideop" value="<?php echo $sqldata['AideOp']; ?>"></td>
	   </tr>
	   
	   <tr><!--FRAIS HA-->
		   <td><label for="fraisha">Frais des honoraires de l'anesth&eacute;siste</label> : </td>
		   <td><input type="text" name="fraisha" id="fraisha" value="<?php echo $sqldata['FraisHA']; ?>"></td>
	   </tr>
	   
	   <tr><!--FRAIS MATERIEL-->
		   <td><label for="fraismat">Mat&eacute;riel implant&eacute;</label> : </td>
		   <td><input type="text" name="fraismat" id="fraismat" value="<?php echo $sqldata['FraisMat']; ?>"></td>
	   </tr>
	   
	   <tr><!--CODE CCAM-->
		   <td><label for="ccam">Code CCAM</label> : </td>
		   <td><input type="text" name="ccam" id="ccam" value="<?php echo $sqldata['Code_CCAM']; ?>"> *</td>
	   </tr>
       <tr><!--CODE CCAM SUITE-->
		   <td colspan="2" style="text-align:right; font-style:italic; font-size:10px;">* uniquement pour les devis de type <b>acte m&eacute;dical</b></td>
	   </tr>
	   
	   <tr> <!--CLINQUE-->
		   <td width="250">
                <label for="cliniqueid">Clinique</label> : 
            </td>
		   <td><select name="cliniqueid" id="cliniqueid">
		   	<option value="<?php echo $sqldataCli['IdClinique']; ?>"><?php echo $sqldataCli['Clinique']; ?></option>
			<?php echo $options; ?>
			</select></td>
	   </tr>
	   
	   <tr><!--DATE ETAB-->
		   <td><label for="dateetab">Date devis</label> : </td>
		   <td><input type="text" name="dateetab" id="dateetab" value="<?php echo $sqldata['Date_Etab']; ?>"></td>
	   </tr>

	   
	   <tr height="60"><!--BOUTONS-->
	   	<td colspan="2"><center><input type="submit" name="enregistrer" value="Enregistrer les modification" />&nbsp;<input type="reset" value="Annuler les modifications"/></center></td>
	   </tr>
	   
	   <tr>
	   	<td id="ancre" colspan="2"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
	   </tr>
   
   </table>
   
   
   </form>
</div>
<?php 
mysql_close();
include("footer.html");

?>