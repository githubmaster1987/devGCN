<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

 
 $sql = "SELECT CROPatients.*, CONCAT( UPPER(Patients.Nom),' ', LOWER(Patients.Prenom)) 'nomprenom'  FROM CROPatients, Patients WHERE CROPatients.Id = '".$_GET['IdCRO']."' AND  CROPatients.PatientId = Patients.Id  LIMIT 1;";
 
$sqlresult = mysql_query($sql);
$sqldata = mysql_fetch_array($sqlresult);
 
 $NomPrenom = $sqldata['nomprenom'];
 $Date =$sqldata['DateInter'];
 
 $Date = substr($Date, 8, 2) . "/" . substr($Date, 5, 2) . "/".substr($Date, 0, 4);
 
 
 $Clinique = $sqldata['Clinique'];
 $Chir = $sqldata['Chirurgien'];
 $Anes = $sqldata['Anesthesiste'];
 $Aide_OP = $sqldata['AideOp'];
 $Titre = $sqldata['Titre'];
 $texte = nl2br($sqldata['Texte']);
 
$sql = "SELECT * FROM `Cliniques` WHERE `IdClinique` = ".$Clinique.";";
 

	$Lib_Add = "29 Avenue Hoche";
	$Lib_Tel = "01 49 53 00 00";
	$Lib_Fax = "01 53 01 46 39";
	$Lib_CP_Ville = "75008 Paris";
	
	
 
 	ob_start();
?>
<style type="text/css">

</style>
<page style="font-size: 12px">
	<table border="0" style="width: 100%">
		<tr>
			<td colspan="3"><img src="images/enteteNoir.jpg" width="750" height="80"/><br /><br /></td>
		</tr>
		<tr>
			<td style="text-align:left; width:35%;">Docteur BELLITY Philippe</td>
			<td style="text-align:left; width:35%;">&nbsp;</td>
			<td style="text-align:left; width:30%;"><i>Consultations : </i></td>
		</tr>
		<tr>
			<td>Ancien Interne des H&ocirc;pitaux</td>
			<td style="text-align:left; width:35%;">&nbsp;</td>
			<td><?php echo $Lib_Add; ?></td>
		</tr>
		<tr>
			<td>Membre du Coll&egrave;ge de Chirugie</td>
			<td style="text-align:left; width:35%;">&nbsp;</td>
			<td><i><?php echo $Lib_CP_Ville; ?></i></td>
		</tr>
		<tr>
			<td>Membre de la SOFCEP</td>
			<td style="text-align:left; width:35%;">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>75 1 70840 5</td>
			<td style="text-align:left; width:35%;">&nbsp;</td>
			<td><b>T&eacute;l: <?php echo $Lib_Tel; ?>  -  Fax: <?php echo $Lib_Fax; ?> </b></td>
		</tr>
	</table>
	<br/>
	<hr />
	<h2 style="text-align:center"><u>COMPTE RENDU OPERATOIRE</u></h2>
	<br/>
	<table border="0" style="width: 100%">
		<tr>
			<td colspan="2"><b>Lieu : </b><?php echo $Clinique;?></td>
		</tr>
		<tr>
			<td style="text-align:left; width:50%;"><b>Nom du patient : </b><?php echo $NomPrenom;?></td>
		</tr>
		<tr>
			<td colspan="2"><b>Date d'intervention : </b><?php echo $Date;?></td>
		</tr>
		<tr>
			<td colspan="2"><b>Chirurgien : </b><?php echo $Chir;?></td>
		</tr>
		<tr>
			<td colspan="2"><b>Clinique : </b><?php echo $Clinique;?></td>
		</tr>
		<tr>
			<td colspan="2"><b>Anesth&eacute;siste : </b><?php echo $Anes;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Aide-op&eacute;ratoire : </b><?php echo $Aide_OP;?></td>
		</tr>
	</table>
	
		<h3 style="text-align:center"><u><?php echo $Titre; ?></u></h3>
		<?php echo $texte ?>
</page>
<?php
	$content = ob_get_clean();
	require_once('html2pdf/html2pdf.class.php');
	$pdf = new HTML2PDF('P','A4','fr');
	$pdf->WriteHTML($content, isset($_GET['vuehtml']));
	$pdf->Output();
?>