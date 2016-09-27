<?php 
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");


if(isset($_POST['Valider']))
{
	extract($_POST);
	$jour = substr($dateNaissance, 0, 2);
	$mois = substr($dateNaissance, 3, 2);
	$annee = substr($dateNaissance, 6, 4);
	$datenew = "$annee-$mois-$jour";
	$sql = "INSERT INTO `Patients` (`Id`, `Sexe`, `Civilite`, `Nom`, `Prenom`, `Age`, `Poids`, `Taille`, `NumSecu`, `Profession`, `Adresse`, `Cp`, `Ville`, `Pays`, `Langue`, `DateN`, `Mail`, `TelD`, `TelB`, `TelP`, `DateCrea`, `Motif`)";
	$sql .= " VALUES (NULL, '$sexe', '$civilite', '$nom', '$prenom', '$age', '$poids', '$taille', '$numsecu', '$profession', '$adresse', '$cp', '$ville', '$pays', '$langue', '$datenew', '$mail', '$telDom', '$telBureau', '$telPortable', NOW(), '$motif');";
	$sqlajout=mysql_query($sql);
	header("Location:index.php");

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
   <form method="post" name="formulaire" onSubmit="return verifGlobale();">
   
   <table cellpadding="2" cellspacing="2">
		<tr>
			<td colspan="3"><center>
				<table border="0" cellspacing="0" cellpadding="0">
				    <tr>
				        <td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
				        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="recherche.php" style="text-decoration:none;">Recherche</a></td>
				        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center></td>
		</tr>
		<tr height="100px">
   			<td colspan="2"><center><h3>Nouvelle fiche</h3></center></td>	
   		</tr>
		<tr> <!--SEXE-->
		   <td width="250"><label for="sexe">Sexe</label> : </td>
		   <td><select name="sexe" id="sexe">
		   	<option value="Femme">Femme</option>
			<option value="Homme">Homme</option>
		   </select></td>
	   </tr>
   		<tr><!--CIVILITE-->
		   <td><label for="civilite">Civilit&eacute;</label> : </td>
		   <td><select name="civilite" id="civilite">
		   	<option value="Madame">Madame</option>
			<option value="Mademoiselle">Mademoiselle</option>
			<option value="Monsieur">Monsieur</option>
		   </select></td>
	   <tr>
	   
	   <tr> <!--NOM-->
		   <td width="250"><label for="nom">Nom</label> : </td>
		   <td><input type="text" name="nom" id="nom"></td>
	   </tr>
	   
	   <tr><!--PRENOM-->
		   <td><label for="prenom">Pr&eacute;nom</label> : </td>
		   <td><input type="text" name="prenom" id="prenom"></td>
	   </tr>
	   
	   <tr><!--DATE NAISSANCE-->
		   <td><label for="dateNaissance">N&eacute;(e) le</label> : </td>
		   <td><input type="text" name="dateNaissance" id="dateNaissance" onblur="calculAge()"/></td>
	   </tr>
	   
	   <tr><!--AGE-->
		   <td><label for="age">Age</label> : </td>
		   <td><input type="text" name="age" id="age"></td>
	   <tr>
	   
	   <tr><!--POIDS-->
		   <td><label for="poids">Poids</label> : </td>
		   <td><input type="text" name="poids" id="poids"></td>
	   </tr>
	   
	   <tr><!--TAILLE-->
		   <td><label for="taille">Taille</label> : </td>
		   <td><input type="text" name="taille" id="taille"></td>
	   </tr>
	   
	   <tr><!--N°SECU-->
		   <td><label for="numsecu">N&deg; S&eacute;curit&eacute; Sociale</label> : </td>
		   <td><input type="text" name="numsecu" id="numsecu"></td>
	   </tr>
	   
	   <tr height="30" valign="bottom"><!--PROFESSION-->
		   <td><label for="profession">Profession</label> : </td>
		   <td><input type="text" name="profession" id="profession"></td>
	   </tr>
	   
	   <tr><!--ADRESSE-->
		   <td><label for="adresse">Adresse</label> : </td>
		   <td><input type="text" name="adresse" id="adresse"></td>
	   </tr>
	   
	   <tr><!--CODE POSTALE-->
		   <td><label for="cp">Code postal</label> : </td>
		   <td><input type="text" name="cp" id="cp"></td>
	   </tr>
	   
	   <tr><!--VILLE-->
		   <td><label for="ville">Ville</label> : </td>
		   <td><input type="text" name="ville" id="ville"></td>
	   </tr>
	   
	   <tr><!--PAYS-->
		   <td><label for="pays">Pays</label> : </td>
		   <td><input type="text" name="pays" id="pays"></td>
	   </tr>
	   
	   <tr height="30" valign="bottom"><!--LANGUE-->
		   <td><label for="langue">Langue</label> : </td>
		   <td><select name="langue" id="langue">
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
		   <td><input type="text" name="mail" id="mail"></td>
	   </tr>
	   
	   <tr><!--TELEPHONE DOMICILE-->
		   <td><label for="telDom">T&eacute;l&eacute;phone Domicile</label> : </td>
		   <td><input type="text" name="telDom" id="telDom"></td>
	   </tr>
	   
	   <tr><!--TELEPHONE BUREAU-->
		   <td><label for="telBureau">T&eacute;l&eacute;phone Bureau</label> : </td>
		   <td><input type="text" name="telBureau" id="telBureau"></td>
	   </tr>
	   
	   <tr><!--TELEPHONE PORTABLE-->
		   <td><label for="telPortable">T&eacute;l&eacute;phone Portable</label> : </td>
		   <td><input type="text" name="telPortable" id="telPortable"></td>
	   </tr>
	  	
	    <tr height="30" valign="bottom"><!--MOTIF-->
		   <td><label for="motif">Motif</label> : </td>
		   <td>
		   	<select name="motif" id="motif">
				<?php echo $options; ?>
			</select>
		   </td>
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
mysql_close();
?>