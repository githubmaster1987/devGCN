<?php 
if(!isset($_GET['IdDevis']))
{
		header("Location:../index.php");
}
else{
	$IdDevis = $_GET['IdDevis'];
}

Require("../connexionBDD.php");

$queryDevis = "SELECT * FROM Devis WHERE `Id`= '".$IdDevis."';";
$queryDevisResult = mysql_query($queryDevis);
$sqldata = mysql_fetch_array($queryDevisResult);
$PatientID = $sqldata['PatientId'];

$heure = $sqldata['Heure_Int'];

$date = $sqldata['Date_Int'];


$CliniqueID = $sqldata['CliniqueId'];

$sqlinfospatient = "SELECT Nom, Prenom, Civilite FROM Patients WHERE Id='".$PatientID."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata_patient= mysql_fetch_array($sqlresult);
$Nom_Prenom = strtoupper($sqldata_patient['Nom'])." ". ucfirst(strtolower($sqldata_patient['Prenom']));
$Sexe = $sqldata['Civilite'];


    



$queryClinique = "SELECT * FROM Cliniques WHERE `IdClinique`= '".$CliniqueID."';";
$queryCliniqueResult = mysql_query($queryClinique);
$sqldata = mysql_fetch_array($queryCliniqueResult);
$Ligne1 = $sqldata['Clinique'];
$Ligne2 = $sqldata['Adresse'] . ", " . $sqldata['Ville'] . " " . $sqldata['CP'];
$Ligne3 = "Tel : ". $sqldata['Tel'];
/*$Ligne4 = "Fax : ". $sqldata['Fax'];
$Ligne5 = "Mail : ". $sqldata['Mail'];*/

require_once('fpdf.php');
require_once('fpdi.php'); 

// initiate FPDI 
$pdf =& new FPDI(); 
// add a page 
$pdf->AddPage(); 
// set the sourcefile 
$pdf->setSourceFile('../Doc/InfosPatients.pdf'); 
// import page 1 


$tplIdx = $pdf->importPage(1); 

$pdf->useTemplate($tplIdx, 0, 0);
$s = $pdf->getTemplatesize($tplIdx); 


$pdf->SetFillColor(255,255,255);	
$pdf->Rect(115.5, 64,20,7, "F");

$pdf->SetFillColor(255,255,255);	
$pdf->Rect(133, 57 ,35,7, "F");

$pdf->SetFillColor(255,255,255);	
$pdf->Rect(0, 0 ,$s['w'],45, "F");
$pdf->Rect(0, $s['h']-45 ,$s['w'],45, "F");

$pdf->setSourceFile('template/template.pdf'); 
$tplheader = $pdf->importPage(1);
$pdf->useTemplate($tplheader, 0, 0);



$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
//$pdf->SetXY(115.8, 66.4); 
$pdf->SetXY(117, 66.4); 
$pdf->Write(1, $heure); 

$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(133.5, 58.4); 
$pdf->Write(1, $date); 

$pdf->SetFontSize(12); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 74.5); 
$pdf->Write(1, $Ligne1); 

$pdf->SetFontSize(9); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 79.9); 
$pdf->Write(1, $Ligne2); 

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 84.5); 
$pdf->Write(1, $Ligne3); 

/**** Ajout Cyril ****/
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 88.9); 
$pdf->Write(1, 'Fax : 0170640036');
//$pdf->Write(1, $Ligne4);

/*$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 93.5); 
$pdf->Write(1, 'Mail : 0170640036');*/




$pdf->Output($Nom_Prenom . ' - Informations.pdf', 'D');
?>