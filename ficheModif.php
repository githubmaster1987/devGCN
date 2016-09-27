<?php 
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");



if(isset($_GET['PatientId']))
{
	$sql = "Select * From `Patients`  Where `Id` = '". $_GET['PatientId']."' LIMIT 1;";	
	$sqlRecup=mysql_query($sql);
	$sqldata = mysql_fetch_array($sqlRecup);
	$dateNaissance = $sqldata['DateN'];
	$jour = substr($dateNaissance, 8, 2);
	$mois = substr($dateNaissance, 5, 2);
	$annee = substr($dateNaissance, 0, 4);
	$datefr = "$jour/$mois/$annee";
}else
{
	header("Location:index.php");
}

if(isset($_POST['enregistrer']))
{
	extract($_POST);
	$jour = substr($dateNaissance, 0, 2);
	$mois = substr($dateNaissance, 3, 2);
	$annee = substr($dateNaissance, 6, 4);
	$datenew = "$annee-$mois-$jour";
	$sql = "UPDATE `Patients` SET `Sexe` = '$sexe', `Civilite` = '$civilite', `Nom` = '$nom', `Prenom` = '$prenom', `Age` = '$age', `Poids` = '$poids', `Taille` = '$taille', `NumSecu` = '$numsecu', `Profession` = '$profession', `Adresse` = '$adresse',";
	$sql .= " `Cp` = '$cp', `Ville` = '$ville', `Pays` = '$pays', `Langue` = '$langue', `DateN` = '$datenew', `Mail` = '$mail', `TelD` = '$telDom', `TelB` = '$telBureau', `TelP` = '$telPortable', `Motif` = '$motif' WHERE `Patients`.`Id` = '".$_POST['PatientId']."' LIMIT 1;";
	$sqlupdate=mysql_query($sql);
	header("Location:fichePatient.php?PatientID=".$_POST['PatientId']);
}

$sqlinfosMotif = "SELECT Texte FROM `Motifs`;";
	$sqlresultMotifs = mysql_query($sqlinfosMotif);
	$options = "";
	while($sqldataMotifs = mysql_fetch_array($sqlresultMotifs))
	{
		$options .= "<option value=\"".$sqldataMotifs['Texte']."\">";
		$options .= $sqldataMotifs['Texte'];
		$options .= "</option>";
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
				        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ficheVierge.php" style="text-decoration:none;">Nouvelle fiche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="recherche.php" style="text-decoration:none;">Recherche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $sqldata['Id']; ?>" style="text-decoration:none;">Retour fiche patient</a></td>
				        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center></td>
		</tr>
   		<tr height="100px">
   			<td colspan="2"><center><h3>Modification fiche <?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?></h3></center></td>	
   		</tr>
		<tr height="60"><!--BOUTONS-->
	   		<td colspan="2"><center><input type="submit" name="enregistrer" value="Enregistrer les modification" onSubmit="return verifGlobale();"/>&nbsp;<input type="reset" value="Annuler les modifications"/></center></td>
	   	</tr>
		<tr> <!--SEXE-->
		   <td width="250"><label for="sexe">Sexe</label> : </td>
		   <td><select name="sexe" id="sexe">
		   	<option value="<?php echo $sqldata['Sexe']; ?>"><?php echo $sqldata['Sexe']; ?></option>
			<option value="Femme">Femme</option>
			<option value="Homme">Homme</option>
		   </select></td>
	   </tr>
		<tr><!--CIVILITE-->
		   <td><label for="civilite">Civilit&eacute;</label> : </td>
		   <td><select name="civilite" id="civilite">
		   	<option value="<?php echo $sqldata['Civilite']; ?>"><?php echo $sqldata['Civilite']; ?></option>
		   	<option value="Madame">Madame</option>
			<option value="Mademoiselle">Mademoiselle</option>
			<option value="Monsieur">Monsieur</option>
		   </select></td>
	   <tr>
	   
	   <tr> <!--NOM-->
		   <td width="250"><label for="nom">Nom</label> : </td>
		   <td><input type="text" name="nom" id="nom" value="<?php echo $sqldata['Nom']; ?>"></td>
	   </tr>
	   
	   <tr><!--PRENOM-->
		   <td><label for="prenom">Pr&eacute;nom</label> : </td>
		   <td><input type="text" name="prenom" id="prenom" value="<?php echo $sqldata['Prenom']; ?>"></td>
	   </tr>
	   
	   <tr><!--DATE NAISSANCE-->
		   <td><label for="dateNaissance">N&eacute;(e) le</label> : </td>
		   <td><input type="text" name="dateNaissance" id="dateNaissance" value="<?php echo $datefr; ?>"></td>
	   </tr>
	   
	   <tr><!--AGE-->
		   <td><label for="age">Age</label> : </td>
		   <td><input type="text" name="age" id="age" value="<?php echo $sqldata['Age']; ?>"></td>
	   <tr>
	   
	   <tr><!--POIDS-->
		   <td><label for="poids">Poids</label> : </td>
		   <td><input type="text" name="poids" id="poids" value="<?php echo $sqldata['Poids']; ?>"></td>
	   </tr>
	   
	   <tr><!--TAILLE-->
		   <td><label for="taille">Taille</label> : </td>
		   <td><input type="text" name="taille" id="taille" value="<?php echo $sqldata['Taille']; ?>"></td>
	   </tr>
	   
	   <tr><!--N°SECU-->
		   <td><label for="numsecu">N&deg; S&eacute;curit&eacute; Sociale</label> : </td>
		   <td><input type="text" name="numsecu" id="numsecu" value="<?php echo $sqldata['NumSecu']; ?>"></td>
	   </tr>
	   
	   <tr height="30" valign="bottom"><!--PROFESSION-->
		   <td><label for="profession">Profession</label> : </td>
		   <td><input type="text" name="profession" id="profession" value="<?php echo $sqldata['Profession']; ?>"></td>
	   </tr>
	   
	   <tr><!--ADRESSE-->
		   <td><label for="adresse">Adresse</label> : </td>
		   <td><input type="text" name="adresse" id="adresse" value="<?php echo $sqldata['Adresse']; ?>"></td>
	   </tr>
	   
	   <tr><!--CODE POSTALE-->
		   <td><label for="cp">Code postal</label> : </td>
		   <td><input type="text" name="cp" id="cp" value="<?php echo $sqldata['Cp']; ?>"></td>
	   </tr>
	   
	   <tr><!--VILLE-->
		   <td><label for="ville">Ville</label> : </td>
		   <td><input type="text" name="ville" id="ville" value="<?php echo $sqldata['Ville']; ?>"></td>
	   </tr>
	   
	   <tr><!--PAYS-->
		   <td><label for="pays">Pays</label> : </td>
		   <td><input type="text" name="pays" id="pays" value="<?php echo $sqldata['Pays']; ?>"></td>
	   </tr>
	   
	   <tr height="30" valign="bottom"><!--LANGUE-->
		   <td><label for="langue">Langue</label> : </td>
		   <td><select name="langue" id="langue">
		   	<option value="<?php echo $sqldata['Langue']; ?>"><?php echo $sqldata['Langue']; ?></option>
			<option value="Francais">Francais</option>
			<option value="Anglais">Allemand</option>
			<option value="Anglais">Anglais</option>
			<option value="Espagnol">Espagnol</option>
			<option value="Grecque">Grecque</option>
			<option value="Italien">Italien</option>
			<option value="Russe">Russe</option>
		   </select></td>
	   </tr>
	   
	   
	   <tr height="30" valign="bottom"><!--MAIL-->
		   <td><label for="mail">Mail</label> : </td>
		   <td><input type="text" name="mail" id="mail" value="<?php echo $sqldata['Mail']; ?>"></td>
	   </tr>
	   
	   <tr><!--TELEPHONE DOMICILE-->
		   <td><label for="telDom">T&eacute;l&eacute;phone Domicile</label> : </td>
		   <td><input type="text" name="telDom" id="telDom" value="<?php echo $sqldata['TelD']; ?>"></td>
	   </tr>
	   
	   <tr><!--TELEPHONE BUREAU-->
		   <td><label for="telBureau">T&eacute;l&eacute;phone Bureau</label> : </td>
		   <td><input type="text" name="telBureau" id="telBureau" value="<?php echo $sqldata['TelB']; ?>"></td>
	   </tr>
	   
	   <tr><!--TELEPHONE PORTABLE-->
		   <td><label for="telPortable">T&eacute;l&eacute;phone Portable</label> : </td>
		   <td><input type="text" name="telPortable" id="telPortable" value="<?php echo $sqldata['TelP']; ?>"></td>
	   </tr>
	   
	   <tr height="30" valign="bottom"><!--MOTIF-->
		   <td><label for="motif">Motif</label> : </td>
		   <td><select name="motif" id="motif">
		   	<option value="<?php echo $sqldata['Motif']; ?>"><?php echo $sqldata['Motif']; ?></option>
			<?php echo $options; ?>
			</select></td>
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